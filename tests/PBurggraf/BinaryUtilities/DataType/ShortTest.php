<?php

namespace PBurggraf\BinaryUtilities\Test\DataType;

use PBurggraf\BinaryUtilities\BinaryUtilities;
use PBurggraf\BinaryUtilities\BinaryUtilityFactory;
use PBurggraf\BinaryUtilities\DataType\Short;
use PBurggraf\BinaryUtilities\EndianType\BigEndian;
use PBurggraf\BinaryUtilities\EndianType\LittleEndian;
use PBurggraf\BinaryUtilities\Exception\DataTypeDoesNotExistsException;
use PBurggraf\BinaryUtilities\Exception\EndianTypeDoesNotExistsException;
use PBurggraf\BinaryUtilities\Exception\FileDoesNotExistsException;
use PBurggraf\BinaryUtilities\Exception\InvalidDataTypeException;
use PBurggraf\BinaryUtilities\Test\BinaryUtilitiesTest;

/**
 * @author Philip Burggraf <philip@pburggraf.de>
 */
class ShortTest extends BinaryUtilitiesTest
{
    /**
     * @throws DataTypeDoesNotExistsException
     * @throws EndianTypeDoesNotExistsException
     * @throws FileDoesNotExistsException
     * @throws InvalidDataTypeException
     */
    public function testReadFirstSingleShortBigEndian()
    {
        $binaryUtility = BinaryUtilityFactory::create();

        $short = $binaryUtility
            ->setFile($this->binaryFile)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(1, $short);
        static::assertEquals([17], $short);
    }

    /**
     * @throws DataTypeDoesNotExistsException
     * @throws EndianTypeDoesNotExistsException
     * @throws FileDoesNotExistsException
     * @throws InvalidDataTypeException
     */
    public function testReadFirstThreeShortBigEndian()
    {
        $binaryUtility = BinaryUtilityFactory::create();
        $short = $binaryUtility
            ->setFile($this->binaryFile)
            ->read(Short::class)
            ->read(Short::class)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(3, $short);
        static::assertEquals([17, 8755, 17493], $short);
    }

    /**
     * @throws DataTypeDoesNotExistsException
     * @throws EndianTypeDoesNotExistsException
     * @throws FileDoesNotExistsException
     * @throws InvalidDataTypeException
     */
    public function testReadFirstThreeShortWithArrayBigEndian()
    {
        $binaryUtility = BinaryUtilityFactory::create();
        $short = $binaryUtility
            ->setFile($this->binaryFile)
            ->readArray(Short::class, 3)
            ->returnBuffer();

        static::assertCount(3, $short);
        static::assertEquals([17, 8755, 17493], $short);
    }

    /**
     * @throws DataTypeDoesNotExistsException
     * @throws EndianTypeDoesNotExistsException
     * @throws FileDoesNotExistsException
     * @throws InvalidDataTypeException
     */
    public function testWriteFirstSingleShortBigEndian()
    {
        $binaryFileCopy = $this->bootstrapWriteableFile();

        $binaryUtility = BinaryUtilityFactory::create();
        $binaryUtility
            ->setFile($binaryFileCopy)
            ->write(Short::class, 0xa0b0)
            ->save();

        $binaryUtility = BinaryUtilityFactory::create();
        $byteArray = $binaryUtility
            ->setFile($binaryFileCopy)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(1, $byteArray);
        static::assertEquals([0xa0b0], $byteArray);
    }

    /**
     * @throws DataTypeDoesNotExistsException
     * @throws EndianTypeDoesNotExistsException
     * @throws FileDoesNotExistsException
     * @throws InvalidDataTypeException
     */
    public function testWriteFirstThreeShortBigEndian()
    {
        $binaryFileCopy = $this->bootstrapWriteableFile();

        $binaryUtility = BinaryUtilityFactory::create();
        $binaryUtility
            ->setFile($binaryFileCopy)
            ->write(Short::class, 0xa0b0)
            ->write(Short::class, 0xa1b1)
            ->write(Short::class, 0xa2b2)
            ->save();

        $binaryUtility = BinaryUtilityFactory::create();
        $byteArray = $binaryUtility
            ->setFile($binaryFileCopy)
            ->read(Short::class)
            ->read(Short::class)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(3, $byteArray);
        static::assertEquals([0xa0b0, 0xa1b1, 0xa2b2], $byteArray);
    }

    /**
     * @throws DataTypeDoesNotExistsException
     * @throws EndianTypeDoesNotExistsException
     * @throws FileDoesNotExistsException
     * @throws InvalidDataTypeException
     */
    public function testReadShortLittleEndian()
    {
        $binaryUtility = BinaryUtilityFactory::create();
        $short = $binaryUtility
            ->setFile($this->binaryFile)
            ->setEndian(LittleEndian::class)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(1, $short);
        static::assertEquals([4352], $short);
    }

    /**
     * @throws DataTypeDoesNotExistsException
     * @throws EndianTypeDoesNotExistsException
     * @throws FileDoesNotExistsException
     * @throws InvalidDataTypeException
     */
    public function testReadFirstThreeShortLittleEndian()
    {
        $binaryUtility = BinaryUtilityFactory::create();
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

    /**
     * @throws DataTypeDoesNotExistsException
     * @throws EndianTypeDoesNotExistsException
     * @throws FileDoesNotExistsException
     * @throws InvalidDataTypeException
     */
    public function testReadFirstThreeShortWithArrayLittleEndian()
    {
        $binaryUtility = BinaryUtilityFactory::create();
        $short = $binaryUtility
            ->setFile($this->binaryFile)
            ->setEndian(LittleEndian::class)
            ->readArray(Short::class, 3)
            ->returnBuffer();

        static::assertCount(3, $short);
        static::assertEquals([4352, 13090, 21828], $short);
    }

    /**
     * @throws DataTypeDoesNotExistsException
     * @throws EndianTypeDoesNotExistsException
     * @throws FileDoesNotExistsException
     * @throws InvalidDataTypeException
     */
    public function testWriteFirstSingleShortLittleEndian()
    {
        $binaryFileCopy = $this->bootstrapWriteableFile();

        $binaryUtility = BinaryUtilityFactory::create();
        $binaryUtility
            ->setFile($binaryFileCopy)
            ->setEndian(LittleEndian::class)
            ->write(Short::class, 0xa0b0)
            ->save();

        $binaryUtility = BinaryUtilityFactory::create();
        $shortArray = $binaryUtility
            ->setFile($binaryFileCopy)
            ->setEndian(LittleEndian::class)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(1, $shortArray);
        static::assertEquals([0xa0b0], $shortArray);

        $binaryUtility = BinaryUtilityFactory::create();
        $shortArray = $binaryUtility
            ->setFile($binaryFileCopy)
            ->setEndian(BigEndian::class)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(1, $shortArray);
        static::assertEquals([0xb0a0], $shortArray);
    }

    /**
     * @throws DataTypeDoesNotExistsException
     * @throws EndianTypeDoesNotExistsException
     * @throws FileDoesNotExistsException
     * @throws InvalidDataTypeException
     */
    public function testWriteFirstThreeShortLittleEndian()
    {
        $binaryFileCopy = $this->bootstrapWriteableFile();

        $binaryUtility = BinaryUtilityFactory::create();
        $binaryUtility->setFile($binaryFileCopy);

        $binaryUtility
            ->setEndian(LittleEndian::class)
            ->write(Short::class, 0xa0b0)
            ->write(Short::class, 0xa1b1)
            ->write(Short::class, 0xa2b2)
            ->save();

        $binaryUtility = BinaryUtilityFactory::create();
        $binaryUtility->setFile($binaryFileCopy);

        $byteArray = $binaryUtility
            ->setEndian(LittleEndian::class)
            ->read(Short::class)
            ->read(Short::class)
            ->read(Short::class)
            ->returnBuffer();

        static::assertCount(3, $byteArray);
        static::assertEquals([0xa0b0, 0xa1b1, 0xa2b2], $byteArray);

        $binaryUtility = BinaryUtilityFactory::create();
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

    /**
     * @throws DataTypeDoesNotExistsException
     * @throws EndianTypeDoesNotExistsException
     * @throws FileDoesNotExistsException
     * @throws InvalidDataTypeException
     */
    public function testWriteFirstThreeShortWithArrayBigEndian()
    {
        $binaryFileCopy = $this->bootstrapWriteableFile();

        $binaryUtility = BinaryUtilityFactory::create();
        $binaryUtility
            ->setFile($binaryFileCopy)
            ->writeArray(Short::class, [0xa0b0, 0xa1b1, 0xa2b2])
            ->save();

        $binaryUtility = BinaryUtilityFactory::create();
        $byteArray = $binaryUtility
            ->setFile($binaryFileCopy)
            ->readArray(Short::class, 3)
            ->returnBuffer();

        static::assertCount(3, $byteArray);
        static::assertEquals([0xa0b0, 0xa1b1, 0xa2b2], $byteArray);
    }

    /**
     * @throws DataTypeDoesNotExistsException
     * @throws EndianTypeDoesNotExistsException
     * @throws FileDoesNotExistsException
     * @throws InvalidDataTypeException
     */
    public function testWriteFirstThreeShortWithArrayLittleEndian()
    {
        $binaryFileCopy = $this->bootstrapWriteableFile();

        $binaryUtility = BinaryUtilityFactory::create();
        $binaryUtility
            ->setFile($binaryFileCopy)
            ->setEndian(LittleEndian::class)
            ->writeArray(Short::class, [0xa0b0, 0xa1b1, 0xa2b2])
            ->save();

        $binaryUtility = BinaryUtilityFactory::create();
        $byteArray = $binaryUtility
            ->setFile($binaryFileCopy)
            ->setEndian(LittleEndian::class)
            ->readArray(Short::class, 3)
            ->returnBuffer();

        static::assertCount(3, $byteArray);
        static::assertEquals([0xa0b0, 0xa1b1, 0xa2b2], $byteArray);

        $binaryUtility = BinaryUtilityFactory::create();
        $byteArray = $binaryUtility
            ->setFile($binaryFileCopy)
            ->setEndian(BigEndian::class)
            ->readArray(Short::class, 3)
            ->returnBuffer();

        static::assertCount(3, $byteArray);
        static::assertEquals([0xb0a0, 0xb1a1, 0xb2a2], $byteArray);
    }
}
