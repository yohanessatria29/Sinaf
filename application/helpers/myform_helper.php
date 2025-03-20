<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( !function_exists('myform_input')) {

   function myform_input($label='', $data='', $value='', $extra='',$desc=false,$lebar=false,$hidden = '') {
      $defaults = array(
         'name' => (( !is_array($data)) ? $data : ''),
         'id' => (( !is_array($data)) ? $data : ''),
         'class' => 'col-sm-3',
         'value' => $value,
      );

      if (is_array($extra)) {
         $defaults = array_merge($defaults, $extra);
         $attributes = _parse_form_attributes($data, $defaults);
      } else {
         $attributes = _parse_form_attributes($data, $defaults).$extra;
      }
	  if($desc)
	  $ket = '<span class="help-inline" style="color:#F00;">'.$desc.'</span>';
	  else
	  $ket = '';
	  //<span class="help-inline">Inline help text</span>
      $error = form_error($defaults['name']);
      $errorClass = ((!empty($error)) ? 'error' : '');
      $out = '<div class="form-group '.$errorClass.'">
         <label class="col-sm-3 control-label" for="'.$defaults['id'].'">'.$label.' '.$ket.'</label>
         <div class="'.$lebar.'">
            <input type="text" '.$attributes.' />'.$hidden.'<span style="color:#F00">'.$error.'</span>
         </div>
      </div>';

      return $out;
   }

}

if ( !function_exists('myform_input2')) {

   function myform_input2($label='', $data='', $value='', $extra='',$desc=false,$lebar=false,$hidden = '') {
      $defaults = array(
         'name' => (( !is_array($data)) ? $data : ''),
         'id' => (( !is_array($data)) ? $data : ''),
         'class' => 'col-sm-3',
         'value' => $value,
      );

      if (is_array($extra)) {
         $defaults = array_merge($defaults, $extra);
         $attributes = _parse_form_attributes($data, $defaults);
      } else {
         $attributes = _parse_form_attributes($data, $defaults).$extra;
      }
	  if($desc)
	  $ket = '<span class="help-inline" style="color:#F00;">'.$desc.'</span>';
	  else
	  $ket = '';
	  //<span class="help-inline">Inline help text</span>
      $error = form_error($defaults['name']);
      $errorClass = ((!empty($error)) ? 'error' : '');
      $out = '<div class="form-group '.$errorClass.'">
         <label class="col-sm-2 control-label" for="'.$defaults['id'].'">'.$label.' '.$ket.'</label>
         <div class="'.$lebar.'">
            <input type="text" '.$attributes.' />'.$hidden.'<span style="color:#F00">'.$error.'</span>
         </div>
      </div>';

      return $out;
   }

}

if ( !function_exists('myform_dv')) {

   function myform_dv($label, $data, $class='input-xlarge') {
      $out = '<div class="control-group">
         <label class="control-label dv-label">'.$label.'</label>
         <div class="controls"><span class="'.$class.' input-label">'.$data.'</span></div>
      </div>';
      return $out;
   }
}

if ( !function_exists('error_class')) {

   function error_class($name) {
      $error = form_error($name);
      $errorClass = ((!empty($error)) ? 'error' : '');
      return $errorClass;
   }
}

if ( !function_exists('myform_div_open')) {

   function myform_div_open($label='', $name='', $label_size = 'col-sm-3', $text_size='col-sm-3') {
      $error = form_error($name);
      $errorClass = ((!empty($error)) ? 'error' : '');
      $out = '<div class="form-group '.$errorClass.'">
         <label class="'.$label_size.' control-label" for="'.$name.'">'.$label.'</label>
         <div class="'.$text_size.'">';

      return $out;
   }

}



if ( !function_exists('myform_div_close')) {

   function myform_div_close($name='') {

      $out = form_error($name).'</div></div>';

      return $out;
   }

}


if ( !function_exists('myform_div_open_ina')) {

   function myform_div_open_ina($label='', $name='', $label_size = 'col-sm-3', $text_size='col-sm-6') {
      $error = form_error($name);
      $errorClass = ((!empty($error)) ? 'error' : '');
      $out = '<div class="form-group '.$errorClass.'">
         <label class="'.$label_size.' control-label" for="'.$name.'">'.$label.'</label>
         <div class="'.$text_size.'">';

      return $out;
   }

}



if ( !function_exists('myform_div_close_ina')) {

   function myform_div_close_ina($name='') {

      $out = form_error($name).'</div></div>';

      return $out;
   }

}


if ( !function_exists('myform_select')) {

   function myform_select($label='', $name='', $options=array(), $selected=array(), $extra='',$desc=false,$label_size = null, $text_size =null ) {
      $defaults = array(
         'name' => $name,
         'id' => $name,
         'class' => 'input-large',
      );
      if(empty($label_size))
	   $label_size = 'col-sm-3';
	  if(empty($text_size))
	   $text_size = 'col-sm-5';
	   
      if (is_array($extra)) {
         $attributes = _parse_form_attributes($extra, $defaults);
      } else {
         $attributes = _parse_form_attributes(null, $defaults).$extra;
      }
      if($desc)
	  $ket = '<span class="help-inline" style="color:#F00;">'.$desc.'</span>';
	  else
	  $ket = '';
	  
      $error = form_error($defaults['name']);
      $errorClass = ((!empty($error)) ? 'error' : '');
      $out = '<div class="form-group '.$errorClass.'">
         <label class="'.$label_size.' control-label" for="'.$defaults['id'].'">'.$label.' '.$ket.'</label>
         <div class="'.$text_size.'">
            '.myform_dropdown($name, $options, $selected, $attributes).'
            <span style="color:#F00">'.$error.'</span>
         </div>
      </div>';

      return $out;
   }

}

if ( !function_exists('myform_select_extra')) {

   function myform_select_extra($label='', $name='', $options=array(), $selected=array(), $extra='',$desc=false,$label_size = null, $text_size =null,$html=null ) {
      $defaults = array(
         'name' => $name,
         'id' => $name,
         'class' => 'input-large',
      );
      if(empty($label_size))
	   $label_size = 'col-sm-3';
	  if(empty($text_size))
	   $text_size = 'col-sm-5';
	   
      if (is_array($extra)) {
         $attributes = _parse_form_attributes($extra, $defaults);
      } else {
         $attributes = _parse_form_attributes(null, $defaults).$extra;
      }
      if($desc)
	  $ket = '<span class="help-inline" style="color:#F00;">'.$desc.'</span>';
	  else
	  $ket = '';
	  
      $error = form_error($defaults['name']);
      $errorClass = ((!empty($error)) ? 'error' : '');
      $out = '<div class="form-group '.$errorClass.'">
         <label class="'.$label_size.' control-label" for="'.$defaults['id'].'">'.$label.' '.$ket.'</label>
         <div class="'.$text_size.'">
            '.myform_dropdown($name, $options, $selected, $attributes).'
            <span style="color:#F00">'.$error.'</span>
         </div>
		 '.$html.'
      </div>';

      return $out;
   }

}

if ( !function_exists('myform_textarea')) {

   function myform_textarea($label='', $data='', $value='', $extra='',$desc=false) {
      $defaults = array(
         'name' => (( !is_array($data)) ? $data : ''),
         'id' => (( !is_array($data)) ? $data : ''),
         'class' => 'form-control',
         'row' => 3,
      );

      if (is_array($extra)) {
         $defaults = array_merge($defaults, $extra);
         $attributes = _parse_form_attributes($data, $defaults);
      } else {
         $attributes = _parse_form_attributes($data, $defaults).$extra;
      }
      if($desc)
	  $ket = '<span class="help-inline" style="color:#F00;">'.$desc.'</span>';
	  else
	  $ket = '';
	  
      $error = form_error($defaults['name']);
      $errorClass = ((!empty($error)) ? 'error' : '');
      $out = '<div class="form-group '.$errorClass.'">
         <label class="col-sm-3 control-label" for="'.$defaults['id'].'">'.$label.'</label>
         <div class="col-sm-6">
            <textarea '.$attributes.'>'.form_prep($value, $defaults['name']).'</textarea>'.$ket.'
            '.$error.'
         </div>
      </div>';

      return $out;
   }

}

if ( !function_exists('myform_radio_group')) {

   function myform_radio_group($label='', $name, $options=array(), $checked=array(), $extra='') {
      $defaults = array(
         'name' => $name,
         'id' => $name,
         'class' => 'radio',
      );

      if (is_array($extra)) {
         $attributes = _parse_form_attributes($extra, $defaults);
      } else {
         $attributes = _parse_form_attributes(null, $defaults).$extra;
      }

      $error = form_error($defaults['name']);
      $errorClass = ((!empty($error)) ? 'error' : '');
      $out = '<div class="control-group '.$errorClass.'">
         <label class="control-label" for="'.$defaults['id'].'">'.$label.'</label>
         <div class="controls">';

      foreach($options as $val => $title) {
         $out .= '<label class="radio inline">
               <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="L" />Laki-laki
            </label>';
      }

         $out .= $error.'
         </div>
      </div>';

      return $out;
   }

}

if ( !function_exists('myform_radio')) {

   function myform_radio($label='', $name, $options=array(), $checked=array(), $extra='') {
      $defaults = array(
         'name' => $name,
         'id' => $name,
         'class' => 'radio',
      );

      if(empty($label_size))
         $label_size = 'col-sm-3';
      
      if(empty($text_size))
         $text_size = 'col-sm-5';

      if (is_array($extra)) {
         $attributes = _parse_form_attributes($extra, $defaults);
      } else {
         $attributes = _parse_form_attributes(null, $defaults).$extra;
      }

      $error = form_error($defaults['name']);
      $errorClass = ((!empty($error)) ? 'error' : '');
      $out = '<div class= "control-group '.$errorClass.'">
               <label class="'.$label_size.' control-label" for="'.$defaults['id'].'">'.$label.'</label>
                  <div class="'.$text_size.'">';

      foreach($options as $val => $title) {

         $out .= '<label class="radio">
                     <input type="radio" id="'.$name.'" name="'.$name.'" value="'.$title.'" />'.$title.'
                  </label>';
      }

         $out .= $error.'
               </div>
              </div>';

      return $out;
   }

}

if ( !function_exists('myform_is_checked')) {
   function myform_is_checked($data, $value) {
      if ($data == $value)
         return 'checked="checked"';
      else
         return;
   }
}

if ( !function_exists('myform_get_val')) {
   function myform_get_val($data, $key, $default='') {
      if (isset($data[$key]))
		switch($data[$key]){
		case (preg_match('|^(\d{4}(?:\-\d{2}){2})$|',$data[$key])? true : false):
			return date('Y-m-d',strtotime($data[$key]));
			break;
		default:
         return $data[$key];
		 break;
		}
      else
         return $default;
   }
}


/**
 * Drop-down Menu
 *
 * @access	public
 * @param	string
 * @param	array
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('myform_dropdown'))
{
	function myform_dropdown($name = '', $options = array(), $selected = array(), $extra = '')
	{
		if ( ! is_array($selected))
		{
			$selected = array($selected);
		}

		// If no selected state was submitted we will attempt to set it automatically
		if (count($selected) === 0)
		{
			// If the form name appears in the $_POST array we have a winner!
			if (isset($_POST[$name]))
			{
				$selected = array($_POST[$name]);
			}
		}

		if ($extra != '') $extra = ' '.$extra;

		$multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

		$form = '<select name="'.$name.'"'.$extra.$multiple.">\n";

		foreach ($options as $key => $val)
		{
			$key = (string) $key;

			if (is_array($val) && ! empty($val))
			{
				$form .= '<optgroup label="'.$key.'">'."\n";

				foreach ($val as $optgroup_key => $optgroup_val)
				{
					$sel = (in_array($optgroup_key, $selected, true)) ? ' selected="selected"' : '';

					$form .= '<option value="'.$optgroup_key.'"'.$sel.'>'.(string) $optgroup_val."</option>\n";
				}

				$form .= '</optgroup>'."\n";
			}
			else
			{
				$sel = (in_array($key, $selected, true)) ? ' selected="selected"' : '';

				$form .= '<option value="'.$key.'"'.$sel.'>'.(string) $val."</option>\n";
			}
		}

		$form .= '</select>';

		return $form;
	}
}



 
 if ( !function_exists('multiple_user')) {
   function multiple_user($group=null) 
   {
      
      $ci = & get_instance();
      if($group == null)
      $select = $ci->db->query("SELECT * FROM user");
      else
      $select = $ci->db->query("SELECT * FROM user WHERE group = ".$group."");

      $data_user = $select->result();
      $option = '<select class="multiple_user" id="multiple_user" name="user[]" multiple="multiple">';
      foreach ($data_user as $key => $value) 
      {
         $option .= '<option value="'.$value->id.'">'.$value->username.'</option>';
      }
      $option .= '</select>';
      

      return $option; //$data;
   }
}

 if ( !function_exists('arr_tahun_for_dropdown')) {
	function arr_tahun_for_dropdown($jumlah_tahun_kebawah,$jumlah_tahun_keatas){
		$arr_year = array();
		$arr_year[intval(date("Y"))] = $this_year = intval(date("Y"));
		for($i=1;$i<=$jumlah_tahun_kebawah;$i++){
			$arr_year[$this_year + $i] = $this_year + $i;
		}
		for($i=1;$i<=$jumlah_tahun_keatas;$i++){
			$arr_year[$this_year - $i] = $this_year - $i;
		}
		asort($arr_year);
		return $arr_year;
	}
} 

if ( !function_exists('generateTextArea')) {
	function generateTextArea($name,$value){
		return myform_textarea('',$name,$value);
	}
}

?>