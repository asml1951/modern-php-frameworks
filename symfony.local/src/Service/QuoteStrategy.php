<?php
/**
 * Created by : alex
 * Date: 10.10.2019
 * Time: 11:39
 */

namespace App\Service;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\ORM\Mapping\ClassMetadata;


class QuoteStrategy implements \Doctrine\ORM\Mapping\QuoteStrategy
{

    private function quote($token, AbstractPlatform $platform)
    {
        // implements my quote strategy
        switch ($platform->getName()) {
            case 'mysql':
            default:
                return '`' . $token . '`';
        }
    }
    /**
     * {@inheritdoc}
     */
    public function getColumnName($fieldName, ClassMetadata $class, AbstractPlatform $platform)
    {
        return $class->fieldMappings[$fieldName]['columnName'];
    }

    /**
     * {@inheritdoc}
     */
    public function getTableName(ClassMetadata $class, AbstractPlatform $platform)
    {
        return $this->quote($class->table['name'], $platform);
    }

    /**
     * {@inheritdoc}
     */
    public function getSequenceName(array $definition, ClassMetadata $class, AbstractPlatform $platform)
    {
        return $definition['sequenceName'];
    }

    /**
     * {@inheritdoc}
     */
    public function getJoinColumnName(array $joinColumn, ClassMetadata $class, AbstractPlatform $platform)
    {
        return $joinColumn['name'];
    }

    /**
     * {@inheritdoc}
     */
    public function getReferencedJoinColumnName(array $joinColumn, ClassMetadata $class, AbstractPlatform $platform)
    {
        return $joinColumn['referencedColumnName'];
    }

    /**
     * {@inheritdoc}
     */
    public function getJoinTableName(array $association, ClassMetadata $class, AbstractPlatform $platform)
    {
        return $association['joinTable']['name'];
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifierColumnNames(ClassMetadata $class, AbstractPlatform $platform)
    {
        return $class->identifier;
    }

    /**
     * {@inheritdoc}
     */
    public function getColumnAlias($columnName, $counter, AbstractPlatform $platform, ClassMetadata $class = null)
    {
        return $platform->getSQLResultCasing($columnName . '_' . $counter);
    }
}