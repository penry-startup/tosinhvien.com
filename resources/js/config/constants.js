/** @desc App configuration */
export const CONST_APP = {
  base_api: process.env.MIX_BASE_API,
  token_key: 'apoly-auth-token',
};

/** @desc Axios configuration */
export const CONST_AXIOS = {
  timeout: 60000,
};

/** @desc Auth configuration */
export const CONST_AUTH = {
  global_middleware: ['check-auth'],
  default_expire: 1,
};

/** @desc Image Default */
export const CONST_IMG = {
  user_empty: require('@/assets/images/default/user-empty.svg').default,
};

/** @desc ReCaptcha */
export const CONST_RECAPTCHA = {
  site_key: '6Lc1nsIdAAAAAP2DXyYWLPgo-uJE4tglFi2vAYCq',
  secret_key: '6Lc1nsIdAAAAADT91DCd5iROhwp3RJHgcYzdgm7a',
};

/** @desc Pagination */
export const CONST_PAGINATION = {
  limit: 10,
};

/** @desc Defined command selection */
export const COMMAND_SELECTION = {
  trash: 'trash',
  restore: 'restore',
  destroy: 'destroy',
};
