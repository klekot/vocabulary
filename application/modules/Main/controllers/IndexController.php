<?php

/**
 *
 */
namespace Main\controllers;

use \GF\Core\AbstractController as AbstractController;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $languages = \Language::all();
        $this->view->languages = $languages;
        parent::indexAction();
    }

    public function translateDirectionAction()
    {
        session_start();
        $_SESSION['from'] = (!empty($_POST['from'])) ? $_POST['from'] : \Language::LANGUAGE_RUSSIAN;
        $_SESSION['to']   = (!empty($_POST['to']))   ? $_POST['to']   : \Language::LANGUAGE_RUSSIAN;
    }

    public function translateAction()
    {
        $word = \Word::find(array(
            'word'             => $_POST['word'],
            'language_id'      => $_SESSION['from']
        ));

        $speech_part = \SpeechPart::find(array(
            'id' => $word->speech_part_id
        ));

        $result = \Translation::find(array(
            'from_language_id' => $_SESSION['from'],
            'to_language_id'   => $_SESSION['to'],
            'word_id'          => $word->id
        ));

        $translation = \Word::find(array(
            'id'               => $result->translation_id,
            'language_id'      => $_SESSION['to']
        ));

        echo json_encode(array(
            'word'             => $word->word,
            'speech_part'      => $speech_part->name,
            'translation'      => $translation->word,
            'transcription'    => $translation->transcription
        ));
        session_destroy();
    }

    public function getAutocompleteVariantsAction()
    {
        $language = $_POST['language'];
        $letters  = $_POST['letters' ];
        $enclosings = \Word::all(array(
            'conditions'  => array(
                '`word` LIKE ? AND `language_id`=?', $letters . '%', $language
            ),
            'limit' => 10
        ));

        $result = array();
        foreach ($enclosings as $enclosing) {
            $result[] = $enclosing->word;
        }

        echo json_encode($result);
    }
}