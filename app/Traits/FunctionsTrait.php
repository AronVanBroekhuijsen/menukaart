<?php

namespace App\Traits;

use Request;

trait FunctionsTrait
{
    /**
     * Paginate items
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function pagination($items, $limit, $page)
    {
        if ($limit != 0) {
            $start = $limit * $page - $limit;
            $pages = ceil(count($items) / $limit);

            $items = $items->slice($start, $limit);
        } else {
            $pages = 1;
        }

        $html = '<div class="pagination">';
        $i = 0;
        while ($i < $pages) {
            $i++;
            $html .= '<a ';
            if($page == $i){
                $html .= 'class="active"';
            }
            $html .= ' href="?';
            if (Request::Input('menu') !== null) {
                $html .= 'menu='.Request::Input('menu').'&';
            }
            if (Request::Input('search_title') !== null) {
                $html .= 'search_title='.Request::Input('search_title').'&';
            }
            $html .= 'page='.$i.'">'.$i.'</a>';
        };
        $html .= '</div>';

        if ($limit == 0) {
            return $html;
        }
        $items->pages = $html;

        return $items;
    }
}
