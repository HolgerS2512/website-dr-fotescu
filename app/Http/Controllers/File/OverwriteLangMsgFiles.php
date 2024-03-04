<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HandleHttp\GetPageUrlVars;
use App\Repositories\File\LanguageMessageFiles;

/**
 * Contains this methods and variables.
 * 
 * @var string $baseLanguage
 * @var array $languageOptions
 * @var string $path
 * @var string $file
 * @var array $fileData
 * @var string $fileKey
 * @var string $fileKeyWord
 * @var array $data
 * @var array $heredoc
 * @var string $hereFace
 * @var string $hereBody
 * @var string $hereFoot
 * @method __construct($fileKey, $data, $path, $file)
 * @method __call($methodeName, $arguments): self
 * @method setAttributes($data): self
 * @method setLanguages($data): void
 * @method setFileData(): void
 * @method setFileKeyWord(): void
 * @method setHeredoc(): void
 * @method getSavePath($var): string
 * @method buildHeredoc($lang, $fileKeyWord, $try, $last): string
 * @method checkVars(): bool
 * @method save(): void
 * 
 */
final class OverwriteLangMsgFiles extends Controller implements LanguageMessageFiles
{
    /**
     * Save the base language.
     *
     * @var string $baseLanguage
     */
    public string $baseLanguage;

    /**
     * Saves the languages.
     *
     * @var array $languageOptions
     */
    public array $languageOptions;

    /**
     * Saves the folder path.
     *
     * @var string $path
     */
    public string $path;

    /**
     * Saves the file name.
     *
     * @var string $file
     */
    public string $file;

    /**
     * Saves the file data.
     *
     * @var array $fileData
     */
    public array $fileData;

    /**
     * Saves the file key.
     *
     * @var string $fileKey
     */
    public string $fileKey;

    /**
     * Saves the file key word.
     *
     * @var string $fileKeyWord
     */
    public string $fileKeyWord;

    /**
     * Saves the category key word.
     *
     * @var string $categoryKey
     */
    public string $categoryKey;

    /**
     * Saves the passed data.
     *
     * @var array $data
     */
    public array $data;

    /**
     * Stores all herdocs strings in an array.
     *
     * @var array $heredoc
     */
    public array $heredoc;

    /**
     * Saves heredoc string.
     *
     * @var string $hereFoot
     */
    public string $hereFace = <<<HereFace



      /*
      |--------------------------------------------------------------------------
    HereFace;

    /**
     * Saves heredoc string.
     *
     * @var string $hereFoot
     */
    public string $hereBody = <<<HereBody
      |--------------------------------------------------------------------------
      |
      | The following language lines are used in the webpage that we need to display to the user.
      |
      |
      |
      */

      
    HereBody;

    /**
     * Saves heredoc string.
     *
     * @var string $hereFoot
     */
    public string $hereFoot = <<<HereFoot


    ];
    HereFoot;

    /**
     * Passes the data to the setters.
     * 
     * @param string $fileKey
     * @param array $data
     * @param string $path
     * @param string $file
     * @return void
     */
    public function __construct(
        string $categoryKey,
        string $fileKey,
        array $data,
        string $path = 'lang/',
        string $file = '/messages.php'
    ) {
        if (!empty($fileKey) && is_array($data)) {

            $this->setAttributes([
                'categoryKey' => $categoryKey,
                'fileKey' => $fileKey,
                'data' => $data,
                'path' => $path,
                'file' => $file,
            ]);

            $this->setLanguages(GetPageUrlVars::$hasLanguages);

            $this->setFileData();

            if ($this->checkVars()) return;

            $this->setFileKeyWord();

            $this->setHeredoc();
        }
    }

    /**
     * Checks whether methods and attributes exist.
     * 
     * @param string $methodeName
     * @param array $arguments
     * @return self
     */
    public function __call($methodeName, $arguments): self
    {
        if (str_starts_with($methodeName, 'set')) {
            $attributeName = lcfirst(substr($methodeName, 3));

            if (property_exists($this, $attributeName)) $this->$attributeName = $arguments[0];

            return $this;
        } else {
            die("Fatale Error - Method $methodeName does not exist!");
        }
    }

    /**
     * Set the value of all given attributes
     *
     * @param array $data
     * @return self
     */
    public function setAttributes(array $data = []): self
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $setterName = 'set' . ucfirst($key);

                if (method_exists($this, $setterName)) {
                    $this->$setterName($value);
                } elseif (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }

        return $this;
    }

    /**
     * Sets the language.
     * 
     * @param string $data
     * @var string $baseLanguage
     * @var array  $languageOptions
     * @return void
     */
    public function setLanguages($data): void
    {
        if ($data) {
            $this->baseLanguage = $data['base'];
            $this->languageOptions = $data['options'];
        }
    }

    /**
     * Sets the filedata to the associated language.
     * 
     * @var string $baseLanguage
     * @var array  $languageOptions
     * @var array  $fileData
     * @return void
     */
    public function setFileData(): void
    {
        if (file_exists($this->getSavePath($this->baseLanguage))) {
            $this->fileData[$this->baseLanguage] = require $this->getSavePath($this->baseLanguage);
        }

        foreach ($this->languageOptions as $lang) {
            if (file_exists($this->getSavePath($lang))) {
                $this->fileData[$lang] = require $this->getSavePath($lang);
            }
        }
    }

    /**
     * Finds and sets the file key word from the file data.
     * 
     * @var string $fileKeyWord
     * @var array  $fileData
     * @return void
     */
    public function setFileKeyWord(): void
    {
        if (!property_exists($this, 'fileData')) return;

        foreach ($this->fileData as $data) {

            foreach ($data as $key => $value) {
                if (array_key_exists($this->fileKey, $value)) {
                    $this->fileKeyWord = $key;
                }
            }
        }
    }

    /**
     * Passes the data to the build function and set the var $heredoc.
     * 
     * @var array  $fileData
     * @return void
     */
    public function setHeredoc(): void
    {
        $note = [];

        foreach ($this->fileData as $lang => $valueArr) {
            $i = 1;
            $vault = '';

            foreach ($valueArr as $key => $_) {

                if ($i < count($valueArr) && $i === 1) {
                    $vault .= $this->buildHeredoc($lang, $key);
                } elseif ($i < count($valueArr)) {
                    $vault .= $this->buildHeredoc($lang, $key, false);
                } else {
                    $note[$lang] = $vault . $this->buildHeredoc($lang, $key, false, true);
                }

                $i++;
            }
        }

        $this->heredoc = $note;
    }

    /**
     * Returns the full path.
     * 
     * @param string $lang
     * @var string $path
     * @var string $file
     * @return string
     */
    public function getSavePath($lang): string
    {
        return base_path() . '/' . $this->path . $lang . $this->file;
    }

    /**
     * Creates the file contents as string with the new data.
     * 
     * @param string $lang
     * @param string $fileKeyWord
     * @param string $categoryKey
     * @param bool $try
     * @param bool $last
     * @var string $fileKeyWord
     * @var string $fileKey
     * @var array  $fileData
     * @var array  $data
     * @var string $hereFace
     * @var string $hereBody
     * @var string $hereFoot
     * @return string
     */
    public function buildHeredoc($lang, $fileKeyWord, $try = true, $last = false): string
    {
        $hereHead = <<<HereHead
        <?php

        return [
        HereHead;

        $msgLine = "\n\t| " . ucfirst($fileKeyWord) . " Message Language Lines\n";

        if (isset($this->fileKeyWord)) {

            if ($this->fileKeyWord === $fileKeyWord) {
                $this->fileData[$lang][$fileKeyWord][$this->fileKey] = $this->data[$lang];
            }
        } else {

            if ($this->categoryKey === $fileKeyWord) {
                $this->fileData[$lang][$this->categoryKey][$this->fileKey] = $this->data[$lang];
            }
        }

        $exportVar = str_replace('array (', '[', var_export($this->fileData[$lang][$fileKeyWord], true));

        $writeFile = '';

        ($try) ? $writeFile .= $hereHead . $this->hereFace : $writeFile .= $this->hereFace;

        $writeFile .= $msgLine;
        $writeFile .= $this->hereBody;
        $writeFile .= "'" . $fileKeyWord . "' => " . substr($exportVar, 0, -1) . "\t],";

        if ($last) $writeFile .= $this->hereFoot;

        return $writeFile;
    }

    /**
     * Checks the variables for completeness.
     * 
     * @var array $data
     * @var string $baseLanguage
     * @var array $languageOptions
     * @return bool
     */
    public function checkVars(): bool
    {
        $checkArr = [];

        foreach ($this->languageOptions as $option) {
            array_push($checkArr, array_key_exists($option, $this->data));
        }

        array_push($checkArr, array_key_exists($this->baseLanguage, $this->data));

        return in_array(false, $checkArr);
    }

    /**
     * Store a newly created resource in messages.php.
     *
     * @return void
     */
    public function save(): void
    {
        if (array_key_exists($this->baseLanguage, $this->data) && file_exists($this->getSavePath($this->baseLanguage))) {
            file_put_contents(
                $this->getSavePath($this->baseLanguage),
                $this->heredoc[$this->baseLanguage],
                FILE_USE_INCLUDE_PATH
            );
        }

        foreach ($this->languageOptions as $lang) {

            if (array_key_exists($lang, $this->data) && file_exists($this->getSavePath($lang))) {
                file_put_contents(
                    $this->getSavePath($lang),
                    $this->heredoc[$lang],
                    FILE_USE_INCLUDE_PATH
                );
            }
        }
    }
}
