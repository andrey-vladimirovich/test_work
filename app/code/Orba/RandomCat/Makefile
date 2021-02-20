COMPONENT_NAME:=random-cat-module
COMPONENT:=orba/random-cat-module
SKELETON:=

TARGET_PATH:=source/packages/$(COMPONENT_NAME)

MKTEMP:=mktemp -d
TMPDIR:=$(shell $(MKTEMP))
ARCHIVE:=$(TMPDIR)/archive.tar.gz
CP:=cp -R
RM:=rm -rf
TAR:=tar
GIT:=git
MKDIR=mkdir -p

#@todo handle windows

.PHONY: all

all:
	$(info Running)
	$(info $(TMPDIR))

	$(TAR) -czvf $(ARCHIVE) .
	$(RM) ..?* .[!.]* *
	$(GIT) clone $(SKELETON) .
	$(MAKE) new \
		project=$(COMPONENT_NAME) \
		version=2.4.1 \
		edition=community \
		unit_cases=packages/$(COMPONENT_NAME)/Test/Unit \
		integration_cases=packages/$(COMPONENT_NAME)/Test/Integration \
		ca=0
	$(MKDIR) $(TARGET_PATH)
	$(TAR) -xzvf $(ARCHIVE) -C $(TARGET_PATH)
	$(RM) $(TMPDIR)
	$(MAKE) run cmd="composer\ require\ $(COMPONENT)"