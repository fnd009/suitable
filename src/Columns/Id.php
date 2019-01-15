<?php

namespace Laravolt\Suitable\Columns;

class Id extends Column implements ColumnInterface
{
    public function cell($cell, $collection, $loop)
    {
        return $cell->getKey();
    }
}
