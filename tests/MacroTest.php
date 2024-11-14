<?php

use Illuminate\Database\Schema\Blueprint;

it('has the blueprint unit macro', function () {
    $tableName = 'test_table';
    $columnName = 'example_column';

    Schema::create($tableName, function (Blueprint $table) use ($columnName) {
        $table->unit($columnName);
    });

    $column = Schema::getColumnListing($tableName);

    expect($column)->toContain($columnName)
        ->and(Schema::getColumnType($tableName, $columnName))
        ->toBe('text');

    Schema::drop($tableName);
});
