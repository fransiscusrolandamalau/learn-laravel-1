import VueRouter from 'vue-router';

import Home from './pages/Home';
import About from './pages/About';
import Register from './pages/Register';
import Login from './pages/Login';
import Dashboard from './pages/user/Dashboard';
import AdminDashboard from './pages/admin/Dashboard';

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            auth: undefined
        }
    },
    {
        path: '/about',
        name: 'about',
        component: About,
        meta: {
            auth: undefined
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            auth: true
        }
    },
    {
        path: '/admin',
        name: 'admin.dashboard',
        component: AdminDashboard,
        meta: {
            auth: {
                roles: -1,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        }
    },
]

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
});
export default router;