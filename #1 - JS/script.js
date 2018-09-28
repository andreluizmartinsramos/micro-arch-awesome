const Template = (function(){

    const listView = document.querySelector("#listView");
    const languageSelect = document.querySelector("#language");

    const config = new Proxy({        
        language: localStorage.getItem('lang') || 'en-US',
        listItems: JSON.parse(sessionStorage.getItem('listItems')) || []
    },{
        set: function(target, prop, value, receiver){
            if(prop === 'listItems' || prop === 'language'){
                Reflect.set(...arguments);
                render();
                return true;
            }
            return false;
        }
    });

    function setList(list){
        sessionStorage.setItem('listItems', JSON.stringify(list));
        config.listItems = list;
        render();
    }

    languageSelect.value = config.language;
    languageSelect.addEventListener("change", changeLanguage);

    function changeLanguage(){
        config.language = languageSelect.value;
        localStorage.setItem('lang', languageSelect.value);
        console.log(languageSelect.value);
    }  

    function render(){
        let html = '';
        const numberFormatter = new Intl.NumberFormat(config.language);
        const dateFormatter = new Intl.DateTimeFormat(config.language, {week: 'long', year: 'numeric', month: 'long', day: 'numeric'});  

        config.listItems.forEach(item => {
            var created_at = dateFormatter.format(new Date(item.created_at));
            var forks = numberFormatter.format(item.forks);
    
            html += `
                <li>
                    <div><b>Name: </b>${item.full_name}</div>
                    <div><b>Created At: </b>${created_at}</div>
                    <div><b>Forks: </b>${forks}</div>
                </li>
            `;
        });
        
        listView.innerHTML = html;
    }    

    return {  
        config,      
        setList
    }

})();

const Data = (function($){
    const searchInput = document.querySelector("#msg")

    searchInput.addEventListener('keypress', function(e){
        
        const searchTerm = searchInput.value || "js"

        if(e.keyCode === 13){
            getDataFromGit(searchTerm)
        }
    })

    function getDataFromGit(term){

        fetch('https://api.github.com/search/repositories?q='+term)
            .then(response => response.json())
            .then(response => response.items)
            .then($.setList)
    }

    return {
        getDataFromGit
    }

})(Template);

(function(){
    render();
})