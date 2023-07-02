<?php

namespace Antheta\Falcon\Parsers;

use Antheta\Falcon\Parsers\Interfaces\ParserInterface;

class Form implements ParserInterface
{
    protected $forms = [];
    protected $parsed = [];

    public function parse($input): array
    {
        if (!$input) {
            return [];
        }

        foreach ($input as $node) {
            $this->forms = $node->find("form") ? $node->find("form") : [];
        }

        $this->parseForms();

        return $this->parsed;
    }

    protected function parseForms() {
        foreach($this->forms as $form) {
            // ** metadata
            $this->parsed["metadata"] = $form->attr();
            // ** inputs
            $this->parsed["inputs"] = $this->inputs($form);
            // ** textareas
            $this->parsed["textareas"] = $this->textareas($form);
            // ** selects
            $this->parsed["selects"] = $this->selects($form);
            // ** buttons
            $this->parsed["buttons"] = $this->buttons($form);
        }
    }

    protected function inputs($form)
    {
        $parsedItems = [];
        $items = $form->find("input");
        if ($items) {
            foreach ($items as $item) {
                $parsedItems[] = array_merge(["element" => "input", "text" => $item->text()], $item->attr());
            }
        }

        return $parsedItems;
    }

    protected function textareas($form)
    {
        $parsedItems = [];
        $items = $form->find("textarea");
        if ($items) {
            foreach ($items as $item) {
                $parsedItems[] = array_merge(["element" => "textarea", "text" => $item->text()], $item->attr());
            }
        }

        return $parsedItems;
    }

    protected function buttons($form)
    {
        $parsedItems = [];
        $items = $form->find("button");
        if ($items) {
            foreach ($items as $item) {
                $parsedItems[] = array_merge(["element" => "button", "text" => $item->text()], $item->attr());
            }
        }

        return $parsedItems;
    }

    protected function selects($form)
    {
        $parsedItems = [];
        $items = $form->find("select");
        if ($items) {
            foreach ($items as $item) {
                $parsedItem = [];
                $parsedSubItem = [];
                $parsedSubItems = [];
                $subItems = $form->find("option");
                if ($subItems) {
                    foreach ($subItems as $subItem) {
                        $parsedSubItems[] = array_merge(
                            ["element" => "option", "text" => $subItem->text()],
                            $subItem->attr()
                        );
                    }
                }

                $parsedItem[] = array_merge(
                    ["element" => "select"], 
                    $item->attr(),
                    ["subItems" => $parsedSubItems]
                );

                $parsedItems[] = $parsedItem;
            }
        }

        return $parsedItems;
    }
}