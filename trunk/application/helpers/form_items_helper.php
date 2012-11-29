<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * gen_dropdown
 * 
 * Funkcia generuje combobox komponent na str�nku. Pod�a vstupn�ch parametrov ho nastavuje a nap��a d�tami.
 *
 * @param name N�zov elementu, t�to hodnota bude pou��t� ako hodnota atrib�tu "name" v elemente "option"
 * @param id_selected ID�ko z�znamu, ktor� m� by� defaultne v comboboxe vybran�.
 * @param data array of object alebo array of array, ni��� array mus� ako indexy pou��va� string
 * @param id_index Ktor� st�pec v data obsahuje indexy hodn�t ktor� sa zobrazuj� v comboboxe.
 * @param value_index Ktor� st�pec v data obsahuje hodnoty ktor� sa zobrazuj� v comboboxe.
 *
 * @return Objekt ktor� obsahuje atrib�ty riadku.
 */
function gen_dropdown($name, $id_selected, $data, $id_index, $value_index)
{
	$options = array();
	
	foreach ($data as $val)
	{
		if (is_object($val))
			$val = get_object_vars($val);
		$options[$val[$id_index]] = $val[$value_index];
	}
	
	return form_dropdown($name, $options, $id_selected);
}

//prve je name tj to je to co je name="...", dalej je id kotre bude default selectnute, $data je array of obejcts z DB podla funkcie ktoru ams specifikovanu v class diagram
//id_index a value_index su nayvz stlpcov v DB vacsinou tie ktore maju suffix id a _name