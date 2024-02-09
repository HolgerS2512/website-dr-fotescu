<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageFactory extends Model
{
    public $locale;
    public $lang = [
        'de' => [
            'contactTrue' => 'Ihre Nachricht wurde erfolgreich gesendet',
            'contactFalse' => 'Leider ist ein Problem aufgetreten. Bitte versuchen Sie es zu einem späteren Zeitpunkt noch einmal.',
        ],
        'en' => [
            'contactTrue' => 'Your message has been sent successfully',
            'contactFalse' => 'Unfortunately, a problem has occurred. Please try again later.',
            'loginTrue' => 'You are logged in!',
            'loginFalse' => 'Login failed',
        ],
        'ru' => [
            'contactTrue' => 'Ваше сообщение было отправлено успешно',
            'contactFalse' => 'K сожалению, возникла проблема. Пожалуйста, повторите попытку позже.',
        ],
    ];

    public $contactTrue, $contactFalse;
    public $loginTrue, $loginFalse;

    /**
     * Method __construct - set the language of locale attribute
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
     * Method __set - set the value of all attributes
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
     * Method __call - check if a method exists
     * 
     * @param string $methodeName, $arguments
     *
     * @return self an error message if method does not exist
     *
     */
    public function __call($methodeName, $arguments)
    {
        if (str_starts_with($methodeName, 'set')) {

            $attributeName = lcfirst(substr($methodeName, 3));

            if (property_exists($this, $attributeName)) $this->$attributeName = $arguments[0];

            return $this;
        } else {
            die("Fatal error - method $methodeName does not exist!");
        }
    }

    /**
     * Method setAttributes - set the value to the associated language
     *
     * @return self
     */
    public function setAttributes(): self
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
