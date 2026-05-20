import { useEffect, useState } from "react";
import {
  BrowserRouter,
  Routes,
  Route,
  Link,
  useParams,
} from "react-router-dom";
import "./App.css";

const API_KEY = "7b81c47b326f4eb2a6f3737c2fbd4284";

function Layout({ children }) {
  return (
    <div className="page">
      <nav className="navbar">
        <Link to="/">Home</Link>
        <Link to="/about">About</Link>
      </nav>

      <main className="content">{children}</main>

      <footer className="footer">CPIT-405 | React Examples</footer>
    </div>
  );
}

function Home() {
  const [query, setQuery] = useState("pasta");
  const [recipes, setRecipes] = useState([]);
  const [loading, setLoading] = useState(false);

  async function searchRecipes() {
    if (!query.trim()) return;

    setLoading(true);

    try {
      const response = await fetch(
        `https://api.spoonacular.com/recipes/complexSearch?apiKey=${API_KEY}&query=${query}&number=10`
      );

      const data = await response.json();
      setRecipes(data.results || []);
    } catch (error) {
      console.error("Error fetching recipes:", error);
    }

    setLoading(false);
  }

  useEffect(() => {
    searchRecipes();
  }, []);

  return (
    <Layout>
      <div className="search-area">
        <input
          type="text"
          value={query}
          onChange={(event) => setQuery(event.target.value)}
        />

        <button onClick={searchRecipes}>SEARCH</button>
      </div>

      {loading && <p>Loading...</p>}

      <div className="recipe-grid">
        {recipes.map((recipe) => (
          <div className="recipe-card" key={recipe.id}>
            {recipe.image && (
              <img src={recipe.image} alt={recipe.title} />
            )}

            <Link to={`/recipe/${recipe.id}`} className="recipe-title">
              {recipe.title}
            </Link>
          </div>
        ))}
      </div>
    </Layout>
  );
}

function RecipeDetails() {
  const { id } = useParams();
  const [recipe, setRecipe] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    async function getRecipeDetails() {
      try {
        const response = await fetch(
          `https://api.spoonacular.com/recipes/${id}/information?apiKey=${API_KEY}`
        );

        const data = await response.json();
        setRecipe(data);
      } catch (error) {
        console.error("Error fetching recipe details:", error);
      }

      setLoading(false);
    }

    getRecipeDetails();
  }, [id]);

  if (loading) {
    return (
      <Layout>
        <p>Loading...</p>
      </Layout>
    );
  }

  if (!recipe) {
    return (
      <Layout>
        <p>Recipe not found.</p>
      </Layout>
    );
  }

  return (
    <Layout>
      <div className="details">
        <h1>{recipe.title}</h1>

        {recipe.image && (
          <img className="details-image" src={recipe.image} alt={recipe.title} />
        )}

        {recipe.summary && (
          <p
            className="summary"
            dangerouslySetInnerHTML={{ __html: recipe.summary }}
          />
        )}

        <h2>Ingredients</h2>

        <ul>
          {recipe.extendedIngredients?.map((ingredient, index) => (
            <li key={index}>{ingredient.original}</li>
          ))}
        </ul>

        <h2>Instructions</h2>

        {recipe.analyzedInstructions &&
        recipe.analyzedInstructions.length > 0 ? (
          <ol>
            {recipe.analyzedInstructions[0].steps.map((step) => (
              <li key={step.number}>{step.step}</li>
            ))}
          </ol>
        ) : recipe.instructions ? (
          <div dangerouslySetInnerHTML={{ __html: recipe.instructions }} />
        ) : (
          <p>No instructions available.</p>
        )}
      </div>
    </Layout>
  );
}

function About() {
  return (
    <Layout>
      <h1>About</h1>
      <p>This is a recipe search app built with React.</p>
    </Layout>
  );
}

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/recipe/:id" element={<RecipeDetails />} />
        <Route path="/about" element={<About />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;