import { useState } from "react";
import { BrowserRouter, Routes, Route, Link } from "react-router-dom";
import "./styles.css";

function Home() {
  const [longUrl, setLongUrl] = useState("");
  const [customUrl, setCustomUrl] = useState("");
  const [shortUrl, setShortUrl] = useState("");

  function handleShorten() {
    if (!longUrl.trim()) {
      alert("Please enter a URL");
      return;
    }

    const customText = customUrl.trim();

    if (customText) {
      setShortUrl(`https://short.ly/${customText}`);
    } else {
      const randomCode = Math.random().toString(36).substring(2, 8);
      setShortUrl(`https://short.ly/${randomCode}`);
    }
  }

  return (
    <div className="card">
      <h1>Link Shrinker App</h1>
      <p className="subtitle">Shorten long URLs into simple shareable links.</p>

      <label>Long URL</label>
      <input
        type="text"
        placeholder="https://example.com/very/long/link"
        value={longUrl}
        onChange={(event) => setLongUrl(event.target.value)}
      />

      <label>Custom Short URL</label>
      <input
        type="text"
        placeholder="my-custom-link"
        value={customUrl}
        onChange={(event) => setCustomUrl(event.target.value)}
      />

      <button onClick={handleShorten}>Shorten URL</button>

      {shortUrl && (
        <div className="result">
          <h3>Your shortened URL:</h3>
          <a href={longUrl} target="_blank" rel="noreferrer">
            {shortUrl}
          </a>
        </div>
      )}
    </div>
  );
}

function About() {
  return (
    <div className="card">
      <h1>About Us</h1>
      <p>
        Link Shrinker App is a simple React application that helps users convert
        long URLs into short and easy-to-share links.
      </p>
      <p>
        This project demonstrates React state management, event handling, and
        routing using React Router.
      </p>
    </div>
  );
}

export default function App() {
  return (
    <BrowserRouter>
      <nav>
        <Link to="/">Home</Link>
        <Link to="/about">About Us</Link>
      </nav>

      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
      </Routes>
    </BrowserRouter>
  );
}