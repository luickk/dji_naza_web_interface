<?php

/* -------------------------------------------------------------------
 *
 * Author: Blupixel IT Srl
 * Last Modifcation Date: 23 Jan 2017
 * Website: www.blupixelit.eu
 * support at: support@blupixelit.eu
 *
 * Copyright (c) 2017 Blupixel IT Srl - Trento (Italy)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *
 * This class provide an easy editor for ini files
 *
 * Use it as described in the sample.php file or using the code below
 *
 *
        include('IniEditor.class.php');

		// initialize the class object
		$ini_editor = new IniEditor();

		// include Javascript and CSS from jQuery and Bootstrap CDN
		echo IniEditor::getCssJsInclude();

		// include class CSS (use your own if you prefer)
		echo IniEditor::getCSS();

		// set folder where to put backups before saving the new version of the file (folder needs write permissions)
		$ini_editor->setBackupFolder('backups');

		// set the path of the file you want to edit or view
		$ini_editor->setIniFile('default.ini');

		// set to true to allow edit of the config file (default is true)
		$ini_editor->enableEdit(true);

		// set to true to allow add of sections and conf in the config file (default is true)
		$ini_editor->enableAdd(true);

		// set to true to allow delete of conf in the config file (default is true)
		$ini_editor->enableDelete(true);


		// print the form. Use $ini_editor->getForm() to store it in a variable
		$ini_editor->printForm();

 *
 * ----------------------------------------------------------------- */


class IniEditor {

	protected $ini_file;
	protected $backup_folder;
	protected $enable_edit = true;
	protected $enable_add = true;
	protected $enable_delete = true;
	protected $scanner_mode = INI_SCANNER_NORMAL;


	// contructor
	public function __construct() {
		$this->backup_folder = 'backup/';
	}

	// set INI file to edit
	public function setIniFile($file) {
		$this->ini_file = $file;
	}

	// set backup folder where to save the backup before saving the new version
	public function setBackupFolder($folder) {
		$this->backup_folder = $folder;
	}

	// enable editing of the file
	public function enableEdit($bool) {
		$this->enable_edit = $bool;
	}

	// enable adding conf and sections in the file
	public function enableAdd($bool) {
		$this->enable_add = $bool;
	}


	// enable adding conf and sections in the file
	public function enableDelete($bool) {
		$this->enable_delete = $bool;
	}

	// get backup filename
	public function backupFilename($filename) {
		return str_replace('/', '_', $filename);
	}

	// set Scanner Mode in parsing the ini file
	public function setScannerMode($mode) {
		$this->scanner_mode = $mode;
	}

	// wrap a value inside quotes
	public function wrapValue($val, $type) {
		if ($type == 'bool')
			if ($val)
				return "true";
			else
				return "false";
		else
			return '"'.str_replace('"', '\\"', $val).'"';
	}

	// find values in array using regexp on the key
	public function preg_grep_keys( $pattern, $input, $flags = 0 ) {
		$keys = preg_grep( $pattern, array_keys( $input ), $flags );
		$vals = array();
		foreach ( $keys as $key )
		{
			$vals[$key] = $input[$key];
		}
		return $vals;
	}

	// save the new file from form request
	public function saveForm() {
		error_reporting(-1);
		ini_set('display_errors', 'On');
		if (!$this->enable_edit) {
			return;
		}
		if (!file_exists($this->backup_folder)) {
			mkdir($this->backup_folder, 0755);
		}

		$backup = file_put_contents($this->backup_folder.'/'.$this->backupFilename($_REQUEST['ini_file']).'.'.date('Ymd_His'), file_get_contents($_REQUEST['ini_file']));

		if ($backup) {
			$vals = $this->preg_grep_keys('/ini#.*$/', $_REQUEST);
			$save = array();
			foreach ($vals as $key => $val) {
				$conf = explode('#', $key);
				if (!isset($save[$conf[1]])) {
					$save[$conf[1]] = array();
				}
				if (is_array($val)) {
					foreach ($val as $k => $v) {
						$save[$conf[1]][] = $conf[2] . '['.(!is_numeric($k)?$k:'').'] = '.$this->wrapValue($v, $conf[3]);
					}
				} else {
					$save[$conf[1]][] = $conf[2] . ' = '.$val;
				}
			}
			$content = '';
			foreach ($save as $section => $rows) {
				$content .= '['.$section.']'."\n";
				$content .= implode("\n", $rows);
				$content .= "\n\n\n";
			}
			$res = file_put_contents($_REQUEST['ini_file'], $content);
			if ($res) {
				echo '<div class="alert alert-success" role="alert">'.$_REQUEST['ini_file'].' saved </div>';
			} else {
				echo '<div class="alert alert-error">'.$_REQUEST['ini_file'].' cannot be saved</div>';
			}
		} else {
			echo '<div class="alert alert-error">Check write permissions on '.$this->backup_folder.'</div>';

		}
	}

	// get Javascript and CSS from jQuery and Bootstrap CDN
	public static function getCssJsInclude() {
		return '<script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
			<link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></link>';
	}

	// get class CSS (use your own if you prefer)
	public static function getCSS() {
		return '<style>
			[onclick] {
				cursor:pointer;
			}
			.editor-container {
				max-width: 90%;
				margin: auto;
				border: 1px solid #D9D9D9;
				padding: 10px;
			}
			.btn{
				font-size: 10px;
				padding: 3px;
			}
			.h3-label{
				font-size: 80%;
				font-weight: normal;
				margin-right: 20px;
			}
			.config-container{
				width: 80%;
				margin-left: 50px;
				display: block;
			}
			textarea.form-control {
				width: 100%;
				display: inline-block;
			}
			.form-group.vector {
				display: inline-block;
				width: 100%;
				vertical-align: top;
			}
			.editor-container fieldset {
				margin-top: 15px;
				margin-bottom: 15px;
			}
			input.btn.btn-success {
				font-size: 16px;
				padding: 10px;
			}
			input.form-control[type="checkbox"] {
				height: 20px;
				margin-top: 0;
				margin-left: 30px;
				width: 20px;
				vertical-align: middle;
			}
			.remove-btn {
				margin-right: 15px;
			}
			.down-arr, .up-arr {
				margin-right: 5px;
			}
			label.array_key {
				margin-top: 10px;
			}
			.form-group span:nth-child(1) .col-md-10 label.array_key {
				margin-top: 0px;
			}
		</style>';
	}

	// get script used to manage the button callback
	public function getScripts() {
		if ($this->enable_edit) {
			return "
			<style>
			input.move-input {
				width: 20px;
				float: left;
				display: inline;
				background: #D9D9D9;
				border: 3px dotted #888;
				margin-right: 5px;
			}
			input.move-input:focus {
				background: #00c4ff;
			}
			</style>
			<script type=\"text/javascript\">
				function addRow(obj, type, isarray) {
					var name = prompt('Which is the name of the new config field?');
					if (!name)
						return;
					var section = $(obj).parents('fieldset').find('legend').find('span:last').text();
					if (isarray == 'array') {
							var namekey = prompt('Which is the key of the first value (leave blank for none)?');
							var html = '<label class=\"col-form-label\"><input type=\"text\" class=\"move-input\" size=\"1\"/>'+name+'</label></div><div class=\"col-md-8\"><div class=\"form-group vector\"><span><div class=\"col-md-10\"><label class=\"array_key\">'+namekey+'</label><textarea rows=\"1\" class=\"form-control\"  name=\"ini#'+section+'#'+name+'#'+type+'['+namekey+']\"></textarea></div><div class=\"col-md-2\"><a href=\"javascript:;\" onclick=\"$(this).parent().parent().insertAfter( $(this).parent().parent().next())\" class=\"down-arr\">&#8595;</a> <a href=\"javascript:;\" onclick=\"$(this).parent().parent().insertBefore( $(this).parent().parent().prev())\" class=\"up-arr\">&#8593;</a>".($this->enable_delete?" <a href=\"javascript:;\" class=\"remove-btn\" onclick=\"$(this).parent().parent().remove();\">X</a>":"")."</div></span></div>';

						html = html + '<table width=\"100%\" class=\"array_add_value\"><tbody><tr><td align=\"center\"><a href=\"javascript:;\" class=\"btn btn-info\" onclick=\"javascript:addArrayRow(this, \\'text\\');\">Add value</a></td></tr></tbody></table></div>';
					} else {
						var html = '<label class=\"col-form-label\"><input type=\"text\" class=\"move-input\" size=\"1\"/>'+name+'</label></div><div class=\"col-md-8\"><textarea rows=\"1\" class=\"form-control\" name=\"ini#'+section+'#'+name+'#'+type+'\"></textarea></div>';
					}
					html = '<div class=\"col-md-4\"><a href=\"javascript:;\" onclick=\"$(this).parent().parent().insertAfter( $(this).parent().parent().next())\" class=\"down-arr\">&darr;</a> <a href=\"javascript:;\" onclick=\"$(this).parent().parent().insertBefore( $(this).parent().parent().prev())\" class=\"up-arr\">&uarr;</a>".($this->enable_delete?" <a href=\"javascript:;\" class=\"remove-btn\" onclick=\"$(this).parents(\\'.form-group\\').remove();\">X</a>":"")." ' + html;
					html = '<div class=\"form-group row\">' + html + '</div>';
					$(obj).parents('fieldset').find('.config-container').append(html);
					$('.move-input:not(.move-initialized)').keydown(function(e) {
							moveOrder(this, e.which);
						});
				}
				function addArrayRow(obj, type) {
					var name = $(obj).parents('.form-group').find('.col-form-label').text();
					var namekey = prompt('Which is the key of the value to add (leave blank for none)?');
					var section = $(obj).parents('fieldset').find('legend span:last').text();
					var html = '<span><div class=\"col-md-10\"><label class=\"array_key\">'+namekey+'</label><textarea rows=\"1\" class=\"form-control\" name=\"ini#'+section+'#'+name+'#'+type+'['+namekey+']\"></textarea></div>';
					html = html + '<div class=\"col-md-2\"><a href=\"javascript:;\" onclick=\"$(this).parent().parent().insertAfter( $(this).parent().parent().next())\" class=\"down-arr\">&darr;</a> <a href=\"javascript:;\" onclick=\"$(this).parent().parent().insertBefore( $(this).parent().parent().prev())\" class=\"up-arr\">&uarr;</a>".($this->enable_delete?" <a href=\"javascript:;\" class=\"remove-btn\" onclick=\"$(this).parent().parent().remove();\">X</a>":"")."</div>';
					$(obj).parents('.col-md-8').find('.form-group:first').append(html);
					$('.move-input:not(.move-initialized)').keydown(function(e) {
							moveOrder(this, e.which);
						});
				}
				function addSection(obj) {
					var section = prompt('Which is the name of the new section?');
					if (!section)
						return;
					//var html = '<fieldset><legend><span><a href=\"javascript:;\" class=\"btn btn-info\" onclick=\"addRow(this, \\'text\\');\">Add text config</a> <a class=\"btn btn-info\"  href=\"javascript:;\" onclick=\"addRow(this, \\'bool\\');\">Add Bool config</a> <a class=\"btn btn-info\" href=\"javascript:;\" onclick=\"addRow(this, \\'text\\', \\'array\\');\">Add Array config</a></span> <span onclick=\"$(this).parent().parent().next().slideToggle();\">'+section+'</span></legend><span class=\"config-container\"></span></fieldset>';
					//$(obj).parents('.editor-container').find('form').prepend(html);
				}
				$(function() {
					$('.move-input:not(.move-initialized)').keydown(function(e) {
							moveOrder(this, e.which);
						});
					});

				function moveOrder(obj, which) {
					$(obj).addClass('move-initialized');
					if (which == 38) { // UP
						$(obj).parents('.form-group:first').find('.up-arr').click();
						$(obj).focus();
					}
					if (which == 40) {// DOWN
						$(obj).parents('.form-group:first').find('.down-arr').click();
						$(obj).focus();
					}

				}
			</script>";
		} else {
			return '<style>
			input.move-input { display: none; }
			</style>';
		}

	}

	// get the form from the file
	public function getForm() {
		$html = '<div class="editor-container">';
		if (isset($_REQUEST['save_ini_form'])) {
			$html .= $this->saveForm();
		}

		if (!is_writeable($this->ini_file)) {
			$html .= '<h4 style="color:red;">'.$this->ini_file.' is not writable</h4>';
		}
		error_reporting(E_ALL);
		$conf = parse_ini_file($this->ini_file, true, $this->scanner_mode);

		$html .= $this->getScripts();

		$html .= '<form method="post">
		<input type="hidden" name="save_ini_form" value="1"/>
		<input type="hidden" name="ini_file" value="'.$this->ini_file.'"/>';

		$additional = array();
		foreach ($conf as $c => $cv) {
			if (in_array('id', array_keys($cv)))
				$conf[$c] = array_merge($additional, $cv);
		}
		foreach ($conf as $c => $cv) {
			$html .= '<div class="card">'."\n";
			$html .= '<div class="card-body">'."\n";
			$html .= '<fieldset><legend>'."\n";

			$html .= '<span onclick="$(this).parent().next().slideToggle();">'.$c.'</span>';
			$html .= '</legend>'."\n";
			$html .= '<span class="config-container container">'."\n";

			foreach ($cv as $label => $val) {
				$html .= '<div class="form-group row">';
				if (!is_array($val)) {
					$html .= '<div class="col-md-4">';
					if ($this->enable_edit) {
						if ($this->enable_delete) {
							$html .= ' <a href="javascript:;" class="remove-btn" onclick="$(this).parents(\'.form-group\').remove();">X</a> ';
						}
					}
					$html .= ' <label class="col-form-label"><input type="text" class="move-input" size="1"/>'.$label.'</label>';
					$html .= '</div>';

					$html .= '<div class="col-md-8">';
				  $html .= '<textarea rows="1" class="form-control" name="ini#'.$c.'#'.$label.'#text">'.$val.'</textarea>';
					$html .= '</div>';
				} else {
					$html .= '<div class="col-md-4">';
					if ($this->enable_edit) {
					if ($this->enable_delete) {
							$html .= '<a class="remove-btn" href="javascript:;" onclick="$(this).parents(\'.form-group\').remove();">X</a> ';
						}
					}

					$html .= ' <label class="col-form-label"><input type="text" class="move-input" size="1"/>'.$label.'</label>';
					$html .= '</div>';

					$html .= '<div class="col-md-8">';
					$html .= '<div class="form-group vector">';
					foreach ($val as $k => $v) {
							$html .= '<span>';
							$html .= '<div class="col-md-10">';
							if (!is_numeric($k)) {
								$html .= '<label class="array_key">'.$k.'</label>';
							}
						       $html .= '<textarea rows="1" class="form-control" name="ini#'.$c.'#'.$label.'#text['.$k.']">'.$v.'</textarea>';
						  $html .= '</div>';

							$html .= '<div class="col-md-2">';
							if ($this->enable_edit) {
								if ($this->enable_delete) {
									$html .= '  <a href="javascript:;" class="remove-btn" onclick="$(this).parent().parent().remove();">X</a>';
								}
							}
							$html .= '</div>';

							$html .= '</span>';
					}
					$html .= '</div>';
					if ($this->enable_add && $this->enable_edit) {
						$html .= '<table width="100%" class="array_add_value"><tr><td align="center"><a href="javascript:;" class="btn btn-info" onclick="javascript:addArrayRow(this, \'text\');">Add value</a></tr></table>';
					}
					$html .= '</div>';
				}

				$html .='</div>'."\n";
			}
			if ($this->enable_edit) {
				$html .= '<input type="Submit" class="btn btn-success" value="Save"/>';
			}
			$html .= '</span>';
			$html .= '</fieldset>'."\n";
			$html .='</div>'."\n";
			$html .='</div>'."\n";
		}

		if ($this->enable_edit) {
			$html .= '<input type="Submit" class="btn btn-dark" value="Save All"/>';
		}

		$html .= '</form>';

		$html .= '</div>';
		return $html;
	}

	// print the form from the file
	public function printForm() {
		echo $this->getForm();
	}

}


?>
