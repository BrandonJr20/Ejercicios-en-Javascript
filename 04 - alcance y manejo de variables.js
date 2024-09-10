// const permite crear variables inmuitables, es decir variables que no pueden cambiar

// Ejemplo, yo declaro la variable estoEsUnaConstante
const estoEsUnaConstante = 50 

// Si en dado caso intetara modificar el valor de su contenido, no se podra, ya que esta es inmutable
estoEsUnaConstante = 98
estoEsUnaConstante++

// Para resolver este problema, existe la variable let que permite crear variables mutables, es decir, que si pueden modificarse sus valores\
let estoEsUnaVariable = 34

// Ejemplo
estoEsUnaVariable = 76
estoEsUnaVariable++

// Creo un objeto el cual es vacio
const obj={}
// si intentase actualizar su contenido agregando un valor no podria ya que no existe una referencia
obj={a}

// Al hacerlo de esta manera si que existiara referencia, ya que en ese momento la estaria creando
obj.a={}

// Una tonta observacion es que no se pueden reasignar dos variables con el mismo nombre