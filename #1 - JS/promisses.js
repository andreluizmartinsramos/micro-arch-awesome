var myPromisse = new Promise((resolve,reject)=>{
    setTimeout(()=>{
        resolve(500)
    },2000)
})

myPromisse
.then(value => {
    console.log(`#1 - The Promisse's value is: ${value}`)
    return 900
})
.then(value => {
    console.log(`#2 - The Promisse's value is: ${value}`)
})