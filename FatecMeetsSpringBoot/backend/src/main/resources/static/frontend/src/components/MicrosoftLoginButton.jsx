import { microsoftLogin } from "../api/auth";

export default function MicrosoftLoginButton() {
  return (
    <button onClick={microsoftLogin} className="bg-blue-600 text-white p-2 rounded">
      Entrar com conta Microsoft
    </button>
  );
}
