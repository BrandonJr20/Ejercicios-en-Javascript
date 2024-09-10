// Manera 1 para crear un objeto
const person = new Object();
person.firstname = "Brandon"
person.lastname ="Cortez"
person.isTeaching = true
person.greet = function(){
    console.log("hi")
}

// Manera dos para crear un objeto
const person2 = {}
person2.firstname ="Junior"
person2["lastname"] = "Vicente"
const key="isTeaching"
person2[key]=true
person2["greet"] = function(){
    console.log("Hi!")
}

// Manera tres para crear un objeto
const person3 = {
    firstname: "Jeni",
    lastname: "Rodas",
    isTeaching: true,
    greet: function () {
        console.log("Hi!")
    },
    // objeto dentro de otro objeto
    adress:{
        street: "Main St.",
        number: 123,
    }
}

console.log("person3")