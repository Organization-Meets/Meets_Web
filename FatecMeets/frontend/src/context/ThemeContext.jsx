import { createContext, useContext, useEffect, useState, useCallback } from 'react';

const ThemeContext = createContext();

const THEME_KEY = 'fm_theme_settings';
const defaultSettings = {
  theme: 'tradicional', // tradicional | claro | escuro
  highContrast: false,
  colorBlind: 'none' // none | deuteranopia | protanopia | tritanopia
};

function loadSettings() {
  try { return { ...defaultSettings, ...(JSON.parse(localStorage.getItem(THEME_KEY)||'{}')) }; } catch { return defaultSettings; }
}

export function ThemeProvider({ children }) {
  const [settings, setSettings] = useState(loadSettings);

  const persist = (next) => {
    setSettings(next);
    localStorage.setItem(THEME_KEY, JSON.stringify(next));
  };

  const setTheme = (theme) => persist({ ...settings, theme });
  const setHighContrast = (highContrast) => persist({ ...settings, highContrast });
  const setColorBlind = (colorBlind) => persist({ ...settings, colorBlind });
  const reset = () => persist(defaultSettings);

  const apply = useCallback(() => {
    const root = document.documentElement;
    root.setAttribute('data-theme', settings.theme);
    const body = document.body;
    body.classList.toggle('high-contrast', settings.highContrast);
    body.classList.remove('cb-deuteranopia','cb-protanopia','cb-tritanopia');
    if (settings.colorBlind !== 'none') body.classList.add('cb-' + settings.colorBlind);
  }, [settings]);

  useEffect(()=> { apply(); }, [apply]);

  return (
    <ThemeContext.Provider value={{ ...settings, setTheme, setHighContrast, setColorBlind, reset }}>
      {children}
    </ThemeContext.Provider>
  );
}

export const useTheme = () => useContext(ThemeContext);
