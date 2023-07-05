<?php

namespace Antheta\Falcon\Parsers;

use Antheta\Falcon\Parsers\Interfaces\ParserInterface;

class Table implements ParserInterface
{
    protected $tables = [];
    protected $parsed = [];

    public function parse(array $input): array
    {
        if (!$input) {
            return [];
        }

        foreach ($input as $node) {
            $this->tables = $node->find("table") ? $node->find("table") : [];
        }

        $this->parseTables();

        return $this->parsed;
    }

    protected function parseTables()
    {
        foreach ($this->tables as $table) {
            // ** metadata
            $this->parsed["metadata"] = $table->attr();
            // ** metadata
            $this->parsed["content"] = $this->tableContents($table);
        }
    }

    protected function tableContents($table)
    {
        $parsedItems = [];
        $items = $table->find('th');
        if ($items) {
            foreach ($items as $item) {
                $parsedItem = [];
                $parsedSubItem = [];
                $parsedSubItems = [];
                $subItems = $table->find('td');
                if ($subItems) {                  
                    foreach ($subItems as $subItem) {
                        $parsedSubItems[] = array_merge(
                            ["element" => "tbody", "text" => $subItem->text()],
                            $subItem->attr()
                        );
                    }
                }

                $parsedItem = array_merge(
                    ["element" => "thead"],
                    $item->attr(),
                    ["text" => $item->text()],
                    ["rows" => $parsedSubItems]
                );

                $parsedItems[] = $parsedItem;
            }
        }

        return $parsedItems;
    }

}