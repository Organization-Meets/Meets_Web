import LoginForm from "../components/LoginForm";
import MicrosoftLoginButton from "../components/MicrosoftLoginButton";

export default function LoginPage() {
  return (
    <div className="p-6">
      <h1>Login</h1>
      <LoginForm />
      <hr />
      <MicrosoftLoginButton />
    </div>
  );
}
