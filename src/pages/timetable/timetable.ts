import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';

@IonicPage({
  name: 'timetable'
})
@Component({
  selector: 'page-timetable',
  templateUrl: 'timetable.html',
})
export class TimetablePage {
  public timetable = [
    {
      day: 'Mon',
      sessions: [
        null,
        {
          name: 'PHP',
          id: 1
        },
        null,
        null
      ],
    },
    {
      day: 'Tue',
      sessions: [
        null,
        null,
        {
          name: 'MOB',
          id: 2
        },
        null,
        {
          name: 'MOB',
          id: 2
        }
      ]
    },
    {
      day: 'Wed',
      sessions: [
        {
          name: 'MOB',
          id: 2
        },
        {
          name: 'MOB',
          id: 2
        },
        null,
        null
      ]
    },
    {
      day: 'Thu',
      sessions: [
        {
          name: 'MOB',
          id: 2
        },
        {
          name: 'MOB',
          id: 2
        },
        null,
        null
      ]
    },
    {
      day: 'Fri',
      sessions: [
        {
          name: 'MOB',
          id: 2
        },
        null,
        null,
        null
      ]
    }
  ];

  public lesson = [
    {
      subject: 'Math',
    },
    {
      subject: 'Science',
    },
    {
      subject: 'Art',
    },
    {
      subject: 'English',
    },
    {
      subject: 'Music',
    }
  ];
  constructor(public navCtrl: NavController, public navParams: NavParams) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad TimetablePage');
  }

}
