<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageFactory extends Model
{
    /**
     * App locale language.
     *
     * @var string
     */
    public $locale;

    /**
     * Language package for passed variable.
     *
     * @var iterable|string
     */
    public $lang = [
        'de' => [
            'contactTrue' => 'Ihre Nachricht wurde erfolgreich gesendet',
            'contactFalse' => 'Leider ist ein Problem aufgetreten. Bitte versuchen Sie es zu einem späteren Zeitpunkt noch einmal.',
        ],
        'en' => [
            'contactTrue' => 'Your message has been sent successfully',
            'contactFalse' => 'Unfortunately, a problem has occurred. Please try again later.',
            'loginTrue' => 'You are logged in!',
            'loginFalse' => 'Login failed!',
            'createPostTrue' => 'Blog post successfully created.',
            'createPostFalse' => 'Database error, created failed!',
            'createBlockTrue' => 'Block successfully created.',
            'createBlockFalse' => 'Database error, created block failed!',
            'uploadTrue' => 'Upload successfully.',
            'uploadFalse' => 'Database error, upload failed!',
            'updateTrue' => 'Update successfully.',
            'updateFalse' => 'Database error, update failed!',
            'deleteTrue' => 'Delete successfully.',
            'deleteFalse' => 'Database error, delete failed!',
            'deletePostTrue' => 'Delete post successfully.',
            'deletePostFalse' => 'Database error, post delete failed!',
            'deleteConTrue' => 'Delete content successfully.',
            'deleteConFalse' => 'Database error, delete content failed!',
            'databaseError' => 'Database error!',
            'methodError' => 'This method is not allowed!',
        ],
        'ru' => [
            'contactTrue' => 'Ваше сообщение было отправлено успешно',
            'contactFalse' => 'K сожалению, возникла проблема. Пожалуйста, повторите попытку позже.',
        ],
    ];

    /**
     * This variables contains the appropriate output in the respective language.
     *
     * @var string
     */
    public $contactTrue, $contactFalse;
    public $loginTrue, $loginFalse;
    public $createPostTrue, $createPostFalse;
    public $createBlockTrue, $createBlockFalse;
    public $uploadTrue, $uploadFalse;
    public $updateTrue, $updateFalse;
    public $deleteTrue, $deleteFalse;
    public $deletePostTrue, $deletePostFalse;
    public $deleteConTrue, $deleteConFalse;
    public $databaseError;
    public $methodError;

    /**
     * Set the language of locale attribute
     *
     * @return self
     */
    public function __construct($locale)
    {
        if (!$locale) {
            $locale = substr(app()->getLocale(), 0, 2);
        }

        if (strlen($locale) === 2) {
            $this->locale = $locale;
        } else {
            $this->locale = 'en';
        }

        $this->setAttributes();
    }

    /**
     * Set the value of all attributes.
     *
     * @param string $name, $value
     *
     * @return self
     */
    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    /**
     * Check if a method exists.
     * 
     * @param string $methodName, $arguments
     *
     * @return self an error message if method does not exist
     *
     */
    public function __call($methodName, $arguments)
    {
        if (str_starts_with($methodName, 'set')) {

            $attributeName = lcfirst(substr($methodName, 3));

            if (property_exists($this, $attributeName)) $this->$attributeName = $arguments[0];

            return $this;
        } else {
            die("Fatal error - method $methodName does not exist!");
        }
    }

    /**
     * Set the value to the associated language
     *
     * @return self
     */
    public function setAttributes()
    {
        foreach ($this->lang as $keys => $values) {

            if ($keys === $this->locale) {

                foreach ($values as $key => $value) {

                    $setterName = 'set' . ucfirst($key);

                    if (method_exists($this, $setterName)) {
                        $this->$setterName($value);
                    } elseif (property_exists($this, $key)) {
                        $this->$key = $value;
                    }
                }
            }
        }

        return $this;
    }
}
