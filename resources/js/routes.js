import Home from './components/App'
import Register from './components/Register'
import Contact from './components/Contact'


export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'register',
        path: '/donor/register',
        component: Register
    },
    {
        name: 'contact',
        path: '/contact',
        component: Contact
    }
];
