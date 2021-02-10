<?php

namespace App\Rules;
use App\Models\Symbol;
use App\Models\Pairs;
use Illuminate\Contracts\Validation\Rule;

class wBazie implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public $kupiona;
    public $sprzedana;
    public static $para;
    public function __construct($kupiona,$sprzedana)
    {
        $this->kupiona = $kupiona;
        $this->sprzedana = $sprzedana;
      
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $symbol = new Pairs();

        self::$para = $this->kupiona.$this->sprzedana;
       
       if($symbol->where('symbol',self::$para)->first())
       {
        return true;
         }
          else
          {
              return false;
           
          }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Nie znaleziono takiej pary walut w bazie.';
    }
}
