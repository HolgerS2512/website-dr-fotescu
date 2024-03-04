<?php

namespace App\Repositories\File;

/**
 * Contains this methods and variables.
 * 
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
interface LanguageMessageFiles
{
  /**
   * Passes the data to the setters.
   * 
   * @param string $categoryKey,
   * @param string $fileKey
   * @param array $data
   * @param string $path
   * @param string $file
   * @return void
   */
  public function __construct(string $categoryKey, string $fileKey, array $data, string $path, string $file);

  /**
   * Checks whether methods and attributes exist.
   * 
   * @param string $methodeName
   * @param array $arguments
   * @return self
   */
  public function __call($methodeName, $arguments): self;

  /**
   * Set the value of all given attributes
   *
   * @param array $data
   * @return self
   */
  public function setAttributes(array $data = []): self;

  /**
   * Sets the language.
   * 
   * @param string $data
   * @var string $baseLanguage
   * @var array  $languageOptions
   * @return void
   */
  public function setLanguages($data): void;

  /**
   * Sets the filedata to the associated language.
   * 
   * @var string $baseLanguage
   * @var array  $languageOptions
   * @var array  $fileData
   * @return void
   */
  public function setFileData(): void;

  /**
   * Finds and sets the file key word from the file data.
   * 
   * @var string $fileKeyWord
   * @var array  $fileData
   * @return void
   */
  public function setFileKeyWord(): void;

  /**
   * Passes the data to the build function and set the var $heredoc.
   * 
   * @var array  $fileData
   * @return void
   */
  public function setHeredoc(): void;

  /**
   * Returns the full path.
   * 
   * @param string $lang
   * @var string $path
   * @var string $file
   * @return string
   */
  public function getSavePath($lang): string;

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
  public function buildHeredoc($lang, $fileKeyWord, $try = true, $last = false): string;

  /**
   * Checks the variables for completeness.
   * 
   * @var array $data
   * @var string $baseLanguage
   * @var array $languageOptions
   * @return bool
   */
  public function checkVars(): bool;

  /**
   * Store a newly created resource in messages.php.
   *
   * @return void
   */
  public function save(): void;
}
