<?php

namespace PBurggraf\BinaryUtilities\Test\DataType;

use org\bovigo\vfs\vfsStream;
use PBurggraf\BinaryUtilities\BinaryUtilities;
use PBurggraf\BinaryUtilities\DataType\Short;
use PBurggraf\BinaryUtilities\EndianType\BigEndian;
use PBurggraf\BinaryUtilities\EndianType\LittleEndian;
use PBurggraf\BinaryUtilities\Test\BinaryUtilitiesTest;

/**
 * @author Philip Burggraf <philip@pburggraf.de>
 */
class ShortTest extends BinaryUtilitiesTest
{
    public function testReadFirstSingleShortBigEndian()
    {
        $binaryUtility = new BinaryUtilities();

        $short = $binaryUtility
            ->setFile($this->binaryFile)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(1, $short);
        static::assertEquals([17], $short);
    }

    public function testReadFirstThreeShortBigEndian()
    {
        $binaryUtility = new BinaryUtilities();
        $short = $binaryUtility
            ->setFile($this->binaryFile)
            ->read(Short::class)
            ->read(Short::class)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(3, $short);
        static::assertEquals([17, 8755, 17493], $short);
    }

    public function testReadFirstThreeShortWithArrayBigEndian()
    {
        $binaryUtility = new BinaryUtilities();
        $short = $binaryUtility
            ->setFile($this->binaryFile)
            ->readArray(Short::class, 3)
            ->returnBuffer();

        static::assertCount(3, $short);
        static::assertEquals([17, 8755, 17493], $short);
    }

    public function testWriteFirstSingleShortBigEndian()
    {
        $binaryFileCopy = $this->bootstrapWriteableFile();

        $binaryUtility = new BinaryUtilities();
        $binaryUtility
            ->setFile($binaryFileCopy)
            ->write(Short::class, 0xa0b0)
            ->save();

        $binaryUtility = new BinaryUtilities();
        $byteArray = $binaryUtility
            ->setFile($binaryFileCopy)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(1, $byteArray);
        static::assertEquals([0xa0b0], $byteArray);
    }

    public function testWriteFirstThreeShortBigEndian()
    {
        $binaryFileCopy = $this->bootstrapWriteableFile();

        $binaryUtility = new BinaryUtilities();
        $binaryUtility
            ->setFile($binaryFileCopy)
            ->write(Short::class, 0xa0b0)
            ->write(Short::class, 0xa1b1)
            ->write(Short::class, 0xa2b2)
            ->save();

        $binaryUtility = new BinaryUtilities();
        $byteArray = $binaryUtility
            ->setFile($binaryFileCopy)
            ->read(Short::class)
            ->read(Short::class)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(3, $byteArray);
        static::assertEquals([0xa0b0, 0xa1b1, 0xa2b2], $byteArray);
    }

    public function testReadShortLittleEndian()
    {
        $binaryUtility = new BinaryUtilities();
        $short = $binaryUtility
            ->setFile($this->binaryFile)
            ->setEndian(LittleEndian::class)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(1, $short);
        static::assertEquals([4352], $short);
    }

    public function testReadFirstThreeShortLittleEndian()
    {
        $binaryUtility = new BinaryUtilities();
        $short = $binaryUtility
            ->setFile($this->binaryFile)
            ->setEndian(LittleEndian::class)
            ->read(Short::class)
            ->read(Short::class)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(3, $short);
        static::assertEquals([4352, 13090, 21828], $short);
    }

    public function testReadFirstThreeShortWithArrayLittleEndian()
    {
        $binaryUtility = new BinaryUtilities();
        $short = $binaryUtility
            ->setFile($this->binaryFile)
            ->setEndian(LittleEndian::class)
            ->readArray(Short::class, 3)
            ->returnBuffer();

        static::assertCount(3, $short);
        static::assertEquals([4352, 13090, 21828], $short);
    }

    public function testWriteFirstSingleShortLittleEndian()
    {
        $binaryFileCopy = $this->bootstrapWriteableFile();

        $binaryUtility = new BinaryUtilities();
        $binaryUtility
            ->setFile($binaryFileCopy)
            ->setEndian(LittleEndian::class)
            ->write(Short::class, 0xa0b0)
            ->save();

        $binaryUtility = new BinaryUtilities();
        $shortArray = $binaryUtility
            ->setFile($binaryFileCopy)
            ->setEndian(LittleEndian::class)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(1, $shortArray);
        static::assertEquals([0xa0b0], $shortArray);

        $binaryUtility = new BinaryUtilities();
        $shortArray = $binaryUtility
            ->setFile($binaryFileCopy)
            ->setEndian(BigEndian::class)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(1, $shortArray);
        static::assertEquals([0xb0a0], $shortArray);
    }

    public function testWriteFirstThreeShortLittleEndian()
    {
        $binaryFileCopy = $this->bootstrapWriteableFile();

        $binaryUtility = new BinaryUtilities();
        $binaryUtility->setFile($binaryFileCopy);

        $binaryUtility
            ->setEndian(LittleEndian::class)
            ->write(Short::class, 0xa0b0)
            ->write(Short::class, 0xa1b1)
            ->write(Short::class, 0xa2b2)
            ->save();

        $binaryUtility = new BinaryUtilities();
        $binaryUtility->setFile($binaryFileCopy);

        $byteArray = $binaryUtility
            ->setEndian(LittleEndian::class)
            ->read(Short::class)
            ->read(Short::class)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(3, $byteArray);
        static::assertEquals([0xa0b0, 0xa1b1, 0xa2b2], $byteArray);

        $binaryUtility = new BinaryUtilities();
        $binaryUtility->setFile($binaryFileCopy);

        $byteArray = $binaryUtility
            ->setEndian(BigEndian::class)
            ->read(Short::class)
            ->read(Short::class)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(3, $byteArray);
        static::assertEquals([0xb0a0, 0xb1a1, 0xb2a2], $byteArray);
    }

    public function testWriteFirstThreeShortWithArrayBigEndian()
    {
        $binaryFileCopy = $this->bootstrapWriteableFile();

        $binaryUtility = new BinaryUtilities();
        $binaryUtility
            ->setFile($binaryFileCopy)
            ->writeArray(Short::class, [0xa0b0, 0xa1b1, 0xa2b2])
            ->save();

        $binaryUtility = new BinaryUtilities();
        $byteArray = $binaryUtility
            ->setFile($binaryFileCopy)
            ->readArray(Short::class, 3)
            ->returnBuffer();

        static::assertCount(3, $byteArray);
        static::assertEquals([0xa0b0, 0xa1b1, 0xa2b2], $byteArray);
    }

    public function testWriteFirstThreeShortWithArrayLittleEndian()
    {
        $binaryFileCopy = $this->bootstrapWriteableFile();

        $binaryUtility = new BinaryUtilities();
        $binaryUtility
            ->setFile($binaryFileCopy)
            ->setEndian(LittleEndian::class)
            ->writeArray(Short::class, [0xa0b0, 0xa1b1, 0xa2b2])
            ->save();

        $binaryUtility = new BinaryUtilities();
        $byteArray = $binaryUtility
            ->setFile($binaryFileCopy)
            ->setEndian(LittleEndian::class)
            ->readArray(Short::class, 3)
            ->returnBuffer();

        static::assertCount(3, $byteArray);
        static::assertEquals([0xa0b0, 0xa1b1, 0xa2b2], $byteArray);

        $binaryUtility = new BinaryUtilities();
        $byteArray = $binaryUtility
            ->setFile($binaryFileCopy)
            ->setEndian(BigEndian::class)
            ->readArray(Short::class, 3)
            ->returnBuffer();

        static::assertCount(3, $byteArray);
        static::assertEquals([0xb0a0, 0xb1a1, 0xb2a2], $byteArray);
    }
}
