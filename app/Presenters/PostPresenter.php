<?php
namespace App\Presenters;

class PostPresenter
{
    /**
     * 性別欄位為M，就顯示Mr.，若性別欄位為F，就顯示Mrs.
     * @param string $gender
     * @param string $name
     * @return string
     */
    public function getFullName($gender, $name)
    {
        if ($gender == 'M')
            $fullName = 'Mr. ' . $name;
        else
            $fullName = 'Mrs. ' . $name;

        return $fullName;
    }
}
