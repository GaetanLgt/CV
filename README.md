<?php
![Alt Text](https://github.com/GaetanLgt/CV/blob/main/cv_Gaetan_LANGLET_Developpeur-full-stack.pdf)

/* A Personne has a name, a prenom, a date_naissance, an email, a tel, a github, a linkedin, a front, a
back, a full, and a library. */

$cv = new Curriculum_Vitae;

namespace GaetanLANGLET;

class Developpeur-Web_Full-Stack
{
	// déclaration d'une identité
	public $nom = 'LANGLET';
	public $prenom = 'Gaëtan';
	private $date_naissance = '29/01/1986';

	protected $email = 'gtn.langlet@gmail.com';
	protected $tel = '06-89-60-21-82';

	protected $github = 'https: //github.com/GaetanLgt';
	protected $linkedin = 'https://www.linkedin.com/in/ga%C3%ABtan-langlet-web-developpeur/';
}
class Compences extends Personne
{
	// déclaration des compentences
	public $front = 'Vue.js';
	public $back = 'Symphony';
	public $full = ['api_palteform', 'axios'];
	protected $library = [
		'css' => ['bootstap', 'materialaze', 
			'naive-ui'],
		'js' => ['axios', 'vue', 'jQuery'],
		'base' => ['HTML5', 'CSS3', 'JS ES6'],
		'OS' => ['Windows', 'Linux'],
	];
}

echo Developpeur-Web_Full-Stack::GaëtanLANGLET;			?>

      	Gaëtan LANGLET
	06-89-60-21-82
	gtn.langlet@gmail.com
    
	Développeur web
   	Saint-Junien,
	Nouvelle-Aquitaine, 	France 
	

