action "Run deploy script" {
  uses = "maddox/actions/ssh@master"
  args = "/opt/deploy/run"
  secrets = [
    ${{ secrets.PRIVATE_KEY }},
    "coderman.ru",
    "root"
  ]
}
