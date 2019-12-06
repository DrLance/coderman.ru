action "Run deploy script" {
  uses = "maddox/actions/ssh@master"
  args = "/opt/deploy/run"
  secrets = [
    "ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDnDvJ2wh69W46KfXXWU/eWuRxalgdcxt5ZMgzlzjc2NzRcIxUSklqs3phFsTCys3l2m2I9xbu4UYOd8TeW56BL9DvIDv89Er/z17TI1H/Wzoz7s9+Az5bwXimTssQmGlZb/HuoS1rLt1xeo4XV9uGa8lo7ozXRvvQPh6Yzb0r5JE9YF4O0Tv7J4YIDRIXpIYOGwrMptJrUXefspKIgKYBj/cONns5Z0qldjeKNMWThh1WueSCV1SHuC6R3iNbK9hHemYZitz2G1dVN9k0pspKXuEsqqhsjVmloM9RMpc0iouLLLXvYRjxmHAUOqFMLsBhuLzcazdqtRyQAnZgLHmjD megalance@gmail.com",
    "185.104.248.212",
    "root"
  ]
}
