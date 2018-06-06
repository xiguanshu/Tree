// pages/morning/morning.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    omoney: 520,
    oday: 99
  },
  qiandao: function () {
    var that = this;
    var oopenid = getApp().globalData.myopenid;
    var otodaydao = getApp().dayData.todaydao;
    if (oopenid) {
      var timestamp = Date.parse(new Date());
      timestamp = timestamp / 1000;
      console.log("当前时间戳为：" + timestamp);
      var n = timestamp * 1000;
      var date = new Date(n);
      var d = date.getDate() < 10 ? '0' + date.getDate() : date.getDate();
      var h = date.getHours();
      if (otodaydao != d) {
        if (h < 7) {
          wx.showToast({
            title: '签到成功',
            icon: 'warn',
            duration: 2000
          })
          getApp().dayData.todaydao = d;
          that.setData({
            omoney: omoney + 5,
            oday: oday + 1,
          })
          wx.request({
            url: '/index.php/',//根据openid修改用户叶子币数he签到天数（叶子币数+5，签到天数+1）
            data: {
              oopenid: oopenid,
            },
            header: {
              'Content-Type': 'application/json'
            },
          })
        }
        else {
          wx.showModal({
            title: '提示',
            content: '签到时间已过',
          })
        }
      }
      else {
        wx.showModal({
          title: '提示',
          content: '您已签到',
        })
      }
    }
    else {
      wx.showModal({
        title: '提示',
        content: '未登录，请先登录',
      })
    }
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    var oopenid = getApp().globalData.myopenid;
    if (oopenid) {
      wx.request({
        url: '/index.php/',//根据openid获取用户叶子币数he签到天数
        data: {
          oopenid: oopenid
        },
        header: {
          'Content-Type': 'application/json'
        },
        success: function (res) {
          // console.log(res.data);
          that.setData({
            omoney: res.data,
            oday: res.data
          })
        }
      })
    }
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})