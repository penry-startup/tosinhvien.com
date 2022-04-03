import request from '@/http/request';
import Resource from '@/http/api/resource';

export default class StaticResource extends Resource {
  constructor() {
    super('/static');
  }

  getCities() {
    return request({
      url: `${this.uri}/list-city`,
      method: 'get',
    });
  }
}
