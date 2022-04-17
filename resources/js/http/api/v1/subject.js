import Resource from '@/http/api/resource';

export default class SubjectResource extends Resource {
  constructor() {
    super('/data-page/subject');
  }
}
