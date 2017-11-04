<?php

# Table: speech_parts
# Primary key: id

class SpeechPart extends \GF\Core\AbstractModel
{
    static $has_many = array(
        array('words')
    );
}