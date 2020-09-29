<?php

class Paginate {

    public $page;
    public $per_page;
    public $total_count;

    public function __construct( $page = 1, $per_page = 4, $total_count = 0 ) {
        $this->page = ( int )$page;
        $this->per_page = ( int )$per_page;
        $this->total_count = ( int )$total_count;
    }

    //1
    public function next() {
        return $this->page + 1;
    }

    //2
    public function previous() {
        return $this->page - 1;
    }

    //3
    public function page_total() {
        return ceil( $this->total_count/$this->per_page );
    }

    //4
    public function has_previous() {
        return ( $this->previous() >= 1 ) ? true : false;
    }

    //5
    public function has_next() {
        return ( $this->next() <= $this->page_total() ) ? true : false;
    }

    //6
    public function offset() {
        // page_start
        return ( $this->page - 1 ) * $this->per_page ;
    }
    
}

?>