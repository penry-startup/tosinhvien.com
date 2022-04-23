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
    icon: 'dashboard',
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
      {
        name: 'Subject Group',
        icon: 'angle-double-right',
        access: 'common',
        children: [
          {
            name: 'Subj Cb Group',
            icon: 'angle-double-right',
            route: 'data-page.subject-combination-group.index',
            access: 'common',
          },
          {
            name: 'Subj Cb',
            icon: 'angle-double-right',
            route: 'data-page.subject-combination.index',
            access: 'common',
          },
          {
            name: 'Subject',
            icon: 'angle-double-right',
            route: 'data-page.subject.index',
            access: 'common',
          },
        ],
      },
    ],
  },
  // ===== #{{ User Map }} ===== //
  {
    name: 'Users',
    icon: 'dashboard',
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
    icon: 'dashboard',
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
