import {Component, ViewChild} from "@angular/core";
import {Platform, Nav, AlertController} from "ionic-angular";
import {StatusBar, Push, Splashscreen} from "ionic-native";
import {TabsPage} from "../pages/tabs/tabs";
import {DetailsPage} from "../pages/details/details";


@Component({
  template: '<ion-nav [root]="rootPage"></ion-nav>'
})
export class MyApp {
  // the root nav is a child of the root app component
  // @ViewChild(Nav) gets a reference to the app's root nav
  @ViewChild(Nav) nav: Nav;
  rootPage: any;

  constructor(public platform: Platform,
              public alertCtrl: AlertController) {
    this.rootPage = TabsPage;

    platform.ready().then(() => {
      // Okay, so the platform is ready and our plugins are available.
      // Here you can do any higher level native things you might need.
      StatusBar.styleDefault();
      Splashscreen.hide();
      let push = Push.init({
        android: {
          senderID: "115655623080"
        },
        ios: {
          alert: "true",
          badge: false,
          sound: "true"
        },
        windows: {}
      });

      push.on('registration', (data) => {
        console.log("device token ->", data.registrationId);
        //TODO - send device token to server
      });
      push.on('notification', (data) => {
        console.log('message', data.message);
        let self = this;
        //if user using app and push notification comes
        if (data.additionalData.foreground) {
          // if application open, show popup
          let confirmAlert = this.alertCtrl.create({
            title: 'New Notification',
            message: data.message,
            buttons: [{
              text: 'Ignore',
              role: 'cancel'
            }, {
              text: 'View',
              handler: () => {
                //TODO: Your logic here
                let notificationAlert = this.alertCtrl.create({
                  title: 'Accepted notification!',
                  message: data.message,
                  buttons: ['OK']
                });
                self.nav.push(DetailsPage, {message: data.message});
                notificationAlert.present();
              }
            }]
          });
          confirmAlert.present();
        } else {
          //if user NOT using app and push notification comes
          //TODO: Your logic on click of push notification directly
          self.nav.push(DetailsPage, {message: data.message});
          let notificationAlert = this.alertCtrl.create({
            title: 'Accepted notification!',
            message: data.message,
            buttons: ['OK']
          });
          notificationAlert.present();
          console.log("Push notification clicked");
        }
      });
      push.on('error', (e) => {
        console.log(e.message);
      });
    });
  }
}
