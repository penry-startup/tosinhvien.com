import Resource from '@/http/api/resource';

export default class MajorResource extends Resource {
  constructor() {
    super('/data-page/major');
  }
}
