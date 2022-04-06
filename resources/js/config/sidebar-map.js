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
  // ===== #{{ User }} ===== //
  {
    name: 'User',
    icon: 'catalog-fill',
    access: 'common',
    children: [
      {
        name: 'Students',
        icon: 'angle-double-right',
        route: 'user.student.index',
        access: 'common',
      },
    ],
  },
];
