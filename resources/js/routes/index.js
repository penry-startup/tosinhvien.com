import { view } from '@/utils/helpers';

export const constantsRoutes = [
  // Overview
  {
    path: '/dashboard',
    name: 'dashboard.index',
    component: view('dashboard'),
  },
  // Auth Routes
  {
    path: '/login',
    name: 'auth.login',
    component: view('auth/Login'),
  },
  {
    path: '/reset-password',
    name: 'auth.reset-password',
    component: view('auth/VerifyEmailForm'),
  },
  {
    path: '/reset-password/:token',
    name: 'auth.reset-password.token',
    component: view('auth/ResetPasswordForm'),
  },
  {
    path: '/auth/profile',
    name: 'auth.profile',
    component: view('profile'),
  },
  // Data Page Routes
  {
    path: '/data-page/university',
    name: 'data-page.university.index',
    component: view('university'),
  },
  {
    path: '/data-page/major',
    name: 'data-page.major.index',
    component: view('major'),
  },
  // Users
  {
    path: '/user/student',
    name: 'user.student.index',
    component: view('student'),
  },
  // Error Routes
  {
    path: '/401',
    name: 'error.401',
    component: view('error/Error401'),
  },
  {
    path: '/404',
    name: 'error.404',
    component: view('error/Error404'),
  },
  {
    path: '/500',
    name: 'error.500',
    component: view('error/Error500'),
  },
  // Base Routes
  { path: '/', name: 'baseURI', redirect: '/login' },
];
