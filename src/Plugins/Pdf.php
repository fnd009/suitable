<?php

namespace Laravolt\Suitable\Plugins;

use Laravolt\Suitable\Builder;
use Laravolt\Suitable\Toolbars\Action;

class Pdf extends Plugin implements \Laravolt\Suitable\Contracts\Plugin
{
    protected $shouldResponse = false;

    protected $filename = 'test.pdf';

    public function init()
    {
        $this->shouldResponse = request('format') === 'pdf';
    }

    public function shouldResponse(): bool
    {
        return $this->shouldResponse;
    }

    public function decorate(Builder $table): Builder
    {
        $url = request()->url().'?'.http_build_query(array_merge(request()->input(), ['format' => 'pdf']));

        $segment = $table->getDefaultSegment();
        $segment->addLeft(Action::make('Export To Pdf', $url));

        return $table;
    }

    public function response($source, Builder $table)
    {
        $table->source($this->resolve($source));

        $columnsKeys = collect($table->getColumns())->map(function($item){
            return $item->id();
        })->toArray();

        if (count($this->only) > 0) {
            $columns = array_intersect($columnsKeys, (array) $this->only);
        } elseif (count($this->except) > 0) {
            $columns = array_diff($columnsKeys, (array) $this->except);
        }

        $table->filterColumns($columns);

        return \niklasravnsborg\LaravelPdf\Facades\Pdf
            ::loadView('suitable::layouts.pdf', ['table' => $table->render('suitable::table')])
            ->stream($this->filename);
    }
}
