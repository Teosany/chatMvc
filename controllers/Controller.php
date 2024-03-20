<?php

namespace App\controllers;

class Controller
{
	public function loadModel($model)
	{
		// On crée une instance de ce modèle.
		return new $model();
	}

	public function render(string $fichier): void
	{
		$class = strtolower(get_class($this)); // Par exemple : chatController
		$dir = preg_replace("#controller#", "", $class);

		// Crée le chemin et inclut le fichier de vue
		require_once(ROOT . 'views/' . $dir . '/' . $fichier . '.php');
	}
}