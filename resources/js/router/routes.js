import AppLayout from '../layouts/App'

export default [
  {
    path: '/',
    redirect: 'dashboard/analytics',
    component: AppLayout,
    meta: { authRequired: true, hidden: true },
    children: [
      {
        path: '/dashboard/analytics',
        // meta: {
        //   title: 'Dashboard Analytics',
        // },
        component: () => import('../views/cards/basic-cards'),
      },
    ]
  },
]