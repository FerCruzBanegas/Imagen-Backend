<?php
    function message($string)
    {
        $json = json_decode(file_get_contents(public_path() . '/message.json'));
        return $json->$string;
    }

    function fullTextWildcardsInitEnd($term)
    {
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);
 
        // $words = explode(' ', $term);
 
        // foreach($words as $key => $word) {
        //     if(strlen($word) >= 1) {
        //         $words[$key] = '+' . $word . '*';
        //     }
        // }
 
        // $searchTerm = implode( ' ', $words);
        // $searchTerm = '+' . $term . '*';
 
        // return $searchTerm;
        if(strlen($term) >= 4) {
            $searchTerm = '"+' . $term . '*"';
        } else if(strlen($term) === 0) {
            $searchTerm = '';
        } else {
            $searchTerm = '+' . $term . '*';
        }

        return $searchTerm;
    }

    function fullTextWildcardsEnd($term)
    {
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);
 
        $words = explode(' ', $term);
 
        foreach($words as $key => $word) {
            if(strlen($word) >= 3) {
                $words[$key] = $word . '*';
            }
        }
 
        $searchTerm = implode( ' ', $words);
 
        return $searchTerm;
    }
?>