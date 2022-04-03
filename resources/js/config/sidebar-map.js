module.exports = [
  {
    name: 'Dashboard',
    icon: 'dashboard',
    route: 'dashboard.index',
    access: 'admin',
  },
  // ===== #{{ Data page }} ===== //
  {
    name: 'Data page',
    icon: 'catalog-fill',
    route: 'dashboard.index',
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
];
