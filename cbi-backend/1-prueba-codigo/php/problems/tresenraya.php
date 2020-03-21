<?php
/*
	Vamos a crear un juego de tres en raya y necesitamos controlar el estado del
	tablero. Para ello, crearemos una función.

	Supongamos que el tablero viene en la forma de un array de 3x3, en el que
	el valor es 0 si la casilla está vacía, 1 si es una X y 2 si es una O, tal
	que así:

	[[0,0,1],
	 [0,1,2],
	 [2,1,0]]

	Lo que queremos es que nuestra función devuelva -1 si el tablero no está
	resuelto, 1 si han ganado las X, 2 si han ganado las O y 0 en caso de
	empate.

	Supondremos que el tablero que se pasa como entrada siempre es válido, dado
	que estamos dentro del contexto de nuestro juego.
*/
function boardState(array $board): int
{

}
