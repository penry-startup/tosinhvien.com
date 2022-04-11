module.exports = [
  {
    name: 'Dashboard',
    icon: 'dashboard',
    route: 'dashboard.index',
    access: 'admin',
  },
  // ===== #{{ Data Page Map }} ===== //
  {
    name: 'Data page',
    icon: 'catalog-fill',
    access: 'common',
    children: [
      {
        name: 'University',
        icon: 'angle-double-right',
        route: 'data-page.university.index',
        access: 'common',
      },
      {
        name: 'Majors',
        icon: 'angle-double-right',
        route: 'data-page.major.index',
        access: 'common',
      },
    ],
  },
  // ===== #{{ User Map }} ===== //
  {
    name: 'Users',
    icon: 'catalog-fill',
    access: 'common',
    children: [
      {
        name: 'Student',
        icon: 'angle-double-right',
        route: 'user.student.index',
        access: 'common',
      },
    ],
  },
  // ===== #{{ Settings Map }} ===== //
  {
    name: 'Settings',
    icon: 'catalog-fill',
    access: 'common',
    children: [
      {
        name: 'Site Management',
        icon: 'angle-double-right',
        route: 'settings.site_management',
        access: 'common',
      },
    ],
  },
];
