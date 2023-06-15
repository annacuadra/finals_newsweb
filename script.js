//NAVBAR
  //DOM MANIPULATION
  const hamburgerBtn = document.getElementById("hamburger");
  const navMenu = document.querySelector(".menu");
  const boxElement = document.querySelector(".box");
  let isBoxHidden = false;

  function toggleHamburger() {
    navMenu.classList.toggle("show");
    if (isBoxHidden) {
      boxElement.style.display = "flex";
    } else {
      boxElement.style.display = "none";
    }
    
    isBoxHidden = !isBoxHidden;
  }

  document.documentElement.addEventListener("click", () => {
    closeDropdownMenu();
    setAriaExpandedFalse();
  });

  hamburgerBtn.addEventListener("click", toggleHamburger);
// END OF NAVBAR

//NEWS CONTENT
  const API_KEY = "6f2cee74f6184a0eb032b544f748d69d";
  const url = "https://newsapi.org/v2/everything?q=";

  async function fetchData(query) {
    const res = await fetch(`${url}${query}&apiKey=${API_KEY}`);
    const data = await res.json();
    return data;
  }

  fetchData("all").then((data) => renderMain(data.articles));

  //ARRAY
  function renderMain(arr) {
    const newsContainer = document.getElementById("news-container");
    let mainHTML = "";
    const maxArticles = Math.min(20, arr.length); // Limit the display to 20 articles
  
    //LOOP
    for (let i = 0; i < maxArticles; i++) {
      if (arr[i].urlToImage) {
        mainHTML += `
          <div class="card">
            <img src="${arr[i].urlToImage}" alt="${arr[i].title}" />
            <h4>${arr[i].title}</h4>
            <div class="publishbyDate">
              <p class="site">${arr[i].source.name}</p>
              <p></p>
              <p class="p-date">${new Date(arr[i].publishedAt).toLocaleDateString()}</p>
            </div>
            <div class="desc">
              ${arr[i].description}
            </div>
            <a href="${arr[i].url}" class="read-more">Read More</a>
          </div>
        `;
      }
    }

    newsContainer.innerHTML = mainHTML;
  }
//END OF NEWS CONTENT

//SEARCH BAR
  //DOM MANIPULATION
  const searchForm = document.getElementById("search-form");
  const searchInput = document.getElementById("search-input");
  
  searchForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const query = searchInput.value;
    const data = await fetchData(query);
    renderMain(data.articles);
  });

  async function Search(query) {
    const data = await fetchData(query);
    renderMain(data.articles);
  }
//END OF SEARCH BAR