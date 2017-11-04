<?php

# Table: translation
# Primary key: id

class Translation extends \GF\Core\AbstractModel
{
    static $has_many = array(
        array('words')
    );
}