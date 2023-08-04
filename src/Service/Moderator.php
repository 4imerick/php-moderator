<?php

namespace App\Service;

class Moderator
{
    public const BLACKLISTED_WORDS = ['Fuck', 'Fucking',  'Asshole', 'Butthole', 'Scumbag', 'Faggot', 'Bitch', 'Bitches', 'Hoe', 'Hoes', 'Bullshit', 'Shit'];

    public const SPECIAL_CHARACTERS = ['.', ',',  ';', '!', '?', '/', '"', '@'];

    /**
     * Method that check if a list of words contains ar least one blacklisted word and return true if it's the case and false if not. 
     * @param string $words 
     * @return bool
     */
    public function isBlacklistedWords(string $words): bool
    {
        // We initialize a variable to confirm when a blacklisted word has been found. 
        $isBlackListed = null;

        // We use the PHP function explode() to create a array from the string. 
        $words = explode(" ", $words);

        foreach ($words as $word) {
            foreach (Moderator::SPECIAL_CHARACTERS as $specialCharacter) {
                // We use the PHP function strlen() to get the lengt of the word and we precise "-1" to extract the last character of the word.
                $lastCharacter = $word[strlen($word) - 1];
                // If the word last character is strictly equal to the special character.
                if ($lastCharacter === $specialCharacter) {
                    // We rewrite the word without the special character.
                    // We use the PHP function str_replace() to remove the last character form the word by remplacing it by a empty value. 
                    $word = str_replace($lastCharacter, "", $word);
                }
            }

            foreach ($this->getBlacklistedWordsWithUpperAndLowerCaseValue() as $blacklistedWord) {
                // If one word of the commentary is stricly equal to a blacklisted word. 
                if ($word === $blacklistedWord) {
                    // We confirm that a blacklisted who have been found in the commentary. 
                    $isBlackListed = true;
                    dd('Form not submitted. ❌ Your commentary contains at least a blacklisted word.');
                    return true;
                }
            }
        }

        // If no blacklisted word has been found. 
        if (!$isBlackListed) {
            return false;
        }
    }

    /** 
     * Methot that convert the blacklisted words in upper and lower case and add this new words to the original array of blacklisted words.
     * @return array $blacklistedWords
     */
    public function getBlacklistedWordsWithUpperAndLowerCaseValue(): array
    {
        $blacklistedWords = Moderator::BLACKLISTED_WORDS;

        foreach ($blacklistedWords as $blacklistedWord) {
            // We use te PHP function array_push() to add the blacklisted word to the array of blacklisted words after converting it in uppercase with the PHP function strtoupper() and lowercase with the PHP function strtolower(). 
            array_push($blacklistedWords, strtoupper($blacklistedWord), strtolower($blacklistedWord));
        }

        return $blacklistedWords;
    }
}
