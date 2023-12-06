<template>
    <div id="app">
      <header>
        <!-- Barre de navigation ou en-tête -->
        <nav>
            <ul class="flex">
            <li class="mr-6">
             <router-link to="/articles" class="text-blue-500 hover:text-blue-800" href="#">Articles</router-link>
             </li>
            <li class="mr-6">
              <a class="text-blue-500 hover:text-blue-800" href="#">Link</a>
             </li>
             <li class="mr-6">
             <a class="text-blue-500 hover:text-blue-800" href="#">Link</a>
            </li>
          <li class="mr-6">
             <a class="text-gray-400 cursor-not-allowed" href="#">Disabled</a>
        </li>
            </ul>
           
        </nav>
      </header>
      
      <main>
        <!-- La balise <router-view> est utilisée pour afficher les composants de votre route actuelle -->
        <router-view></router-view>
      </main>
  
   
    </div>
  </template>
  
  <script>
  export default {
    name: 'App',
    // Ici, vous pouvez ajouter des données, des méthodes, des computed properties, etc., si nécessaire
  };
  </script>
  
  