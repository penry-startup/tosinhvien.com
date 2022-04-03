import request from '@/http/request';
import Resource from '@/http/api/resource';

export default class UniversityResource extends Resource {
  constructor() {
    super('/data-page/university');
  }
  getUniversities() {
    return request({
      url: `${this.uri}/list/get-all`,
      method: 'get',
    });
  }
}
