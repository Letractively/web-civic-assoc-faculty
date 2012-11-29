<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * gen_dropdown
 * 
 * Funkcia generuje combobox komponent na stránku. Pod¾a vstupných parametrov ho nastavuje a napåòa dátami.
 *
 * @param name Názov elementu, táto hodnota bude použítá ako hodnota atribútu "name" v elemente "option"
 * @param id_selected IDèko záznamu, ktorý má by defaultne v comboboxe vybraný.
 * @param data array of object alebo array of array, nižší array musí ako indexy používa string
 * @param id_index Ktorý ståpec v data obsahuje indexy hodnôt ktoré sa zobrazujú v comboboxe.
 * @param value_index Ktorý ståpec v data obsahuje hodnoty ktoré sa zobrazujú v comboboxe.
 *
 * @return Objekt ktorý obsahuje atribúty riadku.
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